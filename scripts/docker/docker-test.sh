#!/bin/bash

# ===================================================================
# BAL Kit Docker Testing Script
# ===================================================================
#
# DISCLAIMER: USE AT YOUR OWN RISK
# This script is provided "AS IS" without warranty of any kind.
# The authors and contributors of this project take NO RESPONSIBILITY
# for any damages, data loss, system issues, or other problems that
# may arise from using this script.
#
# This script runs inside a Docker container to provide complete
# isolation from the host system.
#
# ===================================================================

set -e # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration - optimized for Docker environment
TEST_WORKSPACE_DIR="/tmp/bal-kit-test-workspace" # Use tmpfs for better performance
TEST_APP_DIR="${TEST_WORKSPACE_DIR}/test-app"

# Get version from environment variable or use centralized default
DEFAULT_VERSION=$(php /var/www/bal-kit/bin/version.php constraint 2>/dev/null || echo "^1.5.0")
VERSION="${BAL_KIT_VERSION:-$DEFAULT_VERSION}"

# Test tracking variables
declare -a TEST_RESULTS=()
declare -a TEST_WARNINGS=()
declare -a TEST_ERRORS=()
TOTAL_TESTS=0
PASSED_TESTS=0
FAILED_TESTS=0
WARNING_TESTS=0

# Docker-specific environment check
check_docker_environment() {
    print_info "Running in Docker container environment"
    print_info "Container user: $(whoami)"
    print_info "Working directory: $(pwd)"
    print_info "Available disk space: $(df -h /tmp | tail -1 | awk '{print $4}')"

    # Verify we have necessary tools
    if ! command -v php >/dev/null 2>&1; then
        echo -e "${RED}❌ ERROR: PHP is not available in container${NC}"
        exit 1
    fi

    if ! command -v composer >/dev/null 2>&1; then
        echo -e "${RED}❌ ERROR: Composer is not available in container${NC}"
        exit 1
    fi

    if ! command -v npm >/dev/null 2>&1; then
        echo -e "${RED}❌ ERROR: Node.js/NPM is not available in container${NC}"
        exit 1
    fi

    record_test_pass "Docker Environment - All required tools available"
}

# Setup test workspace in tmpfs
setup_test_workspace() {
    print_info "Setting up Docker test workspace..."

    # Create test workspace directory
    mkdir -p "$TEST_WORKSPACE_DIR"
    cd /var/www/bal-kit # Return to source directory

    print_success "Docker test workspace created at: $TEST_WORKSPACE_DIR"
}

# Helper functions
print_header() {
    echo -e "${BLUE}========================================${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}========================================${NC}"
}

print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

print_info() {
    echo -e "${BLUE}ℹ $1${NC}"
}

# Enhanced test tracking functions
record_test_pass() {
    TOTAL_TESTS=$((TOTAL_TESTS + 1))
    PASSED_TESTS=$((PASSED_TESTS + 1))
    TEST_RESULTS+=("✓ $1")
    print_success "$1"
}

record_test_fail() {
    TOTAL_TESTS=$((TOTAL_TESTS + 1))
    FAILED_TESTS=$((FAILED_TESTS + 1))
    TEST_RESULTS+=("✗ $1")
    TEST_ERRORS+=("$1")
    print_error "$1"
}

record_test_warning() {
    WARNING_TESTS=$((WARNING_TESTS + 1))
    TEST_WARNINGS+=("$1")
    print_warning "$1"
}

# Generate comprehensive test report
generate_final_report() {
    echo ""
    print_header "DOCKER TEST REPORT"

    echo -e "${BLUE}Test Configuration:${NC}"
    echo -e "  📦 BAL Kit Version: ${VERSION}"
    echo -e "  🐳 Environment: Docker Container"
    echo -e "  🔧 Test Mode: ${TEST_MODE:-"all"}"
    echo -e "  📁 Test Workspace: ${TEST_WORKSPACE_DIR}"
    echo ""

    echo -e "${BLUE}Container Information:${NC}"
    echo -e "  🔧 PHP Version: $(php -v | head -1)"
    echo -e "  📦 Composer Version: $(composer --version)"
    echo -e "  🟢 Node.js Version: $(node --version)"
    echo -e "  📦 NPM Version: $(npm --version)"
    echo ""

    echo -e "${BLUE}Test Execution Summary:${NC}"
    echo -e "  📊 Total Tests Run: ${TOTAL_TESTS}"
    echo -e "  ${GREEN}✓ Passed: ${PASSED_TESTS}${NC}"
    echo -e "  ${RED}✗ Failed: ${FAILED_TESTS}${NC}"
    echo -e "  ${YELLOW}⚠ Warnings: ${WARNING_TESTS}${NC}"
    echo ""

    # Calculate success rate
    if [ $TOTAL_TESTS -gt 0 ]; then
        SUCCESS_RATE=$(((PASSED_TESTS * 100) / TOTAL_TESTS))
        echo -e "  🎯 Success Rate: ${SUCCESS_RATE}%"
    else
        echo -e "  🎯 Success Rate: N/A (No tests run)"
    fi

    echo ""
    print_header "DETAILED TEST RESULTS"

    if [ ${#TEST_RESULTS[@]} -gt 0 ]; then
        echo -e "${BLUE}All Test Results:${NC}"
        for result in "${TEST_RESULTS[@]}"; do
            echo -e "  $result"
        done
        echo ""
    fi

    if [ ${#TEST_WARNINGS[@]} -gt 0 ]; then
        echo -e "${YELLOW}Warnings Encountered:${NC}"
        for warning in "${TEST_WARNINGS[@]}"; do
            echo -e "  ⚠ $warning"
        done
        echo ""
    fi

    if [ ${#TEST_ERRORS[@]} -gt 0 ]; then
        echo -e "${RED}Errors Encountered:${NC}"
        for error in "${TEST_ERRORS[@]}"; do
            echo -e "  ✗ $error"
        done
        echo ""
    fi

    # Overall status
    print_header "OVERALL STATUS"
    if [ $FAILED_TESTS -eq 0 ]; then
        if [ $WARNING_TESTS -eq 0 ]; then
            echo -e "${GREEN}🎉 ALL TESTS PASSED! BAL Kit is working perfectly in Docker.${NC}"
        else
            echo -e "${YELLOW}✅ Tests passed with ${WARNING_TESTS} warnings. BAL Kit is functional but review warnings.${NC}"
        fi
    else
        echo -e "${RED}❌ ${FAILED_TESTS} test(s) failed. BAL Kit requires attention.${NC}"
    fi

    echo ""
    print_header "DOCKER ISOLATION BENEFITS"
    echo -e "  🔒 Complete isolation from host system"
    echo -e "  🛡️  No risk to user's local environment"
    echo -e "  📏 Consistent testing environment"
    echo -e "  🔄 Reproducible results across systems"
    echo ""
}

# Test composer dependencies in Docker
test_composer() {
    print_header "Testing Composer Dependencies (Docker)"

    print_info "Testing BAL Kit package availability..."
    # Create a temporary directory for composer test
    temp_dir="${TEST_WORKSPACE_DIR}/composer-test"
    mkdir -p "$temp_dir"
    cd "$temp_dir"

    # Create a minimal composer.json
    cat >composer.json <<EOF
{
    "require": {
        "get-tony/bal-kit": "${VERSION}"
    }
}
EOF

    print_info "Installing BAL Kit package from repository..."
    if composer install --no-interaction --prefer-dist >/dev/null 2>&1; then
        record_test_pass "Docker Composer - Package installation successful"
    else
        record_test_fail "Docker Composer - Package installation failed"
    fi

    print_info "Checking for security vulnerabilities..."
    if composer audit >/dev/null 2>&1; then
        record_test_pass "Docker Composer - Security audit passed"
    else
        record_test_warning "Docker Composer - Security audit found warnings"
    fi

    # Return to source directory
    cd /var/www/bal-kit
}

# Test PHP syntax in Docker
test_php() {
    print_header "Testing PHP Syntax (Docker)"

    print_info "Testing PHP syntax in source files..."
    if find src -name "*.php" -exec php -l {} \; >/dev/null 2>&1; then
        record_test_pass "Docker PHP - All source files valid"
    else
        record_test_fail "Docker PHP - Syntax errors in source files"
    fi

    print_info "Testing PHP syntax in test files..."
    if find tests -name "*.php" -exec php -l {} \; >/dev/null 2>&1; then
        record_test_pass "Docker PHP - All test files valid"
    else
        record_test_fail "Docker PHP - Syntax errors in test files"
    fi
}

# Run PHPUnit tests in Docker
test_phpunit() {
    print_header "Running PHPUnit Tests (Docker)"

    print_info "Installing PHPUnit dependencies..."
    if composer install --no-interaction --prefer-dist >/dev/null 2>&1; then
        record_test_pass "Docker PHPUnit - Dependencies installed"
    else
        record_test_fail "Docker PHPUnit - Failed to install dependencies"
        return
    fi

    print_info "Running Feature tests..."
    if vendor/bin/phpunit --testsuite=Feature --no-coverage >/dev/null 2>&1; then
        record_test_pass "Docker PHPUnit - Feature tests passed"
    else
        record_test_fail "Docker PHPUnit - Feature tests failed"
    fi

    print_info "Running Unit tests..."
    if vendor/bin/phpunit --testsuite=Unit --no-coverage >/dev/null 2>&1; then
        record_test_pass "Docker PHPUnit - Unit tests passed"
    else
        record_test_fail "Docker PHPUnit - Unit tests failed"
    fi

    print_info "Running complete test suite..."
    if vendor/bin/phpunit >/dev/null 2>&1; then
        record_test_pass "Docker PHPUnit - Complete test suite passed"
    else
        record_test_warning "Docker PHPUnit - Complete test suite had issues"
    fi
}

# Test Laravel installation in Docker
test_installation() {
    print_header "Testing Laravel Installation (Docker)"

    setup_test_workspace

    print_info "Creating fresh Laravel application in Docker..."
    cd "$TEST_WORKSPACE_DIR"

    if composer create-project laravel/laravel test-app --no-interaction --prefer-dist >/dev/null 2>&1; then
        record_test_pass "Docker Laravel - Application created successfully"
    else
        record_test_fail "Docker Laravel - Failed to create application"
        return
    fi

    cd test-app

    # Install BAL Kit package
    print_info "Installing BAL Kit package in Docker..."
    if composer require "get-tony/bal-kit:${VERSION}" --no-interaction >/dev/null 2>&1; then
        record_test_pass "Docker Laravel - BAL Kit package installed"
    else
        record_test_fail "Docker Laravel - BAL Kit package installation failed"
        return
    fi

    # Test different installation presets
    print_info "Testing minimal preset in Docker..."
    if php artisan bal:install --preset=minimal --no-interaction >/dev/null 2>&1; then
        record_test_pass "Docker Laravel - Minimal preset installation"
    else
        record_test_fail "Docker Laravel - Minimal preset failed"
    fi

    print_info "Testing standard preset in Docker..."
    if php artisan bal:install --preset=standard --no-interaction >/dev/null 2>&1; then
        record_test_pass "Docker Laravel - Standard preset installation"
    else
        record_test_fail "Docker Laravel - Standard preset failed"
    fi

    # Return to source directory
    cd /var/www/bal-kit
}

# Test frontend assets in Docker
test_frontend() {
    print_header "Testing Frontend Assets (Docker)"

    cd "$TEST_APP_DIR"

    if [ -f "package.json" ]; then
        print_info "Installing NPM dependencies in Docker..."
        if npm ci --silent >/dev/null 2>&1; then
            record_test_pass "Docker Frontend - NPM dependencies installed"
        else
            record_test_fail "Docker Frontend - NPM installation failed"
        fi

        print_info "Building frontend assets in Docker..."
        if npm run build >/dev/null 2>&1 || npm run dev >/dev/null 2>&1; then
            record_test_pass "Docker Frontend - Asset compilation successful"
        else
            record_test_fail "Docker Frontend - Asset compilation failed"
        fi
    else
        record_test_warning "Docker Frontend - package.json not found"
    fi

    # Return to source directory
    cd /var/www/bal-kit
}

# Cleanup Docker test environment
cleanup() {
    print_header "Cleaning Up Docker Test Environment"

    if [ -d "$TEST_WORKSPACE_DIR" ]; then
        print_info "Removing Docker test workspace..."
        rm -rf "$TEST_WORKSPACE_DIR"
        print_success "Docker test workspace cleaned"
    fi
}

# Main Docker testing function
run_all_tests() {
    print_header "BAL Kit Docker Testing Suite"

    check_docker_environment
    test_composer
    test_php
    test_phpunit
    test_installation
    test_frontend

    generate_final_report
}

# Command line argument handling for Docker
case "${1:-all}" in
"composer")
    check_docker_environment
    test_composer
    generate_final_report
    ;;
"php")
    check_docker_environment
    test_php
    generate_final_report
    ;;
"phpunit")
    check_docker_environment
    test_phpunit
    generate_final_report
    ;;
"install")
    check_docker_environment
    test_installation
    generate_final_report
    ;;
"frontend")
    check_docker_environment
    test_installation
    test_frontend
    generate_final_report
    ;;
"all" | "")
    run_all_tests
    ;;
*)
    echo -e "${RED}Unknown Docker test command: $1${NC}"
    echo "Available commands: all, composer, php, phpunit, install, frontend"
    exit 1
    ;;
esac

# Cleanup on exit
trap cleanup EXIT
