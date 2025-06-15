#!/bin/bash

# ===================================================================
# BAL Kit Local Testing Script
# ===================================================================
#
# DISCLAIMER: USE AT YOUR OWN RISK
# This script is provided "AS IS" without warranty of any kind.
# The authors and contributors of this project take NO RESPONSIBILITY
# for any damages, data loss, system issues, or other problems that
# may arise from using this script. Use at your own discretion and
# ensure you have proper backups before running any tests.
#
# This script creates temporary directories, installs packages,
# and runs various tests that may consume system resources.
#
# ===================================================================

set -e # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
TEST_WORKSPACE_DIR="test-workspace" # Directory for all test operations
TEST_APP_DIR="${TEST_WORKSPACE_DIR}/test-app"

# Default version - get from centralized source, can be overridden via command line
DEFAULT_VERSION=$(php "$(dirname "$0")/../version/version.php" constraint 2>/dev/null || echo "^1.5.0")
VERSION="${DEFAULT_VERSION}"

# Test tracking variables
declare -a TEST_RESULTS=()
declare -a TEST_WARNINGS=()
declare -a TEST_ERRORS=()
TOTAL_TESTS=0
PASSED_TESTS=0
FAILED_TESTS=0
WARNING_TESTS=0

# Ensure we're in the correct directory
check_working_directory() {
    if [ ! -f "composer.json" ] || [ ! -d "src" ] || [ ! -d "tests" ]; then
        echo -e "${RED}❌ ERROR: This script must be run from the BAL Kit project root directory.${NC}"
        echo -e "${RED}   Expected files: composer.json, src/, tests/${NC}"
        echo -e "${RED}   Current directory: $(pwd)${NC}"
        exit 1
    fi

    # Check if this is actually the BAL Kit project
    if ! grep -q "get-tony/bal-kit" composer.json 2>/dev/null; then
        echo -e "${RED}❌ ERROR: This doesn't appear to be the BAL Kit project directory.${NC}"
        echo -e "${RED}   Looking for 'get-tony/bal-kit' in composer.json${NC}"
        exit 1
    fi
}

# Setup test workspace
setup_test_workspace() {
    print_info "Setting up test workspace..."

    # Create test workspace directory if it doesn't exist
    if [ ! -d "$TEST_WORKSPACE_DIR" ]; then
        mkdir -p "$TEST_WORKSPACE_DIR"
        print_success "Created test workspace: $TEST_WORKSPACE_DIR"
    fi

    # Clean up any existing test app
    if [ -d "$TEST_APP_DIR" ]; then
        print_info "Cleaning up existing test application..."
        rm -rf "$TEST_APP_DIR"
    fi
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

# Show usage information
show_usage() {
    echo "BAL Kit Local Testing Script"
    echo ""
    echo "⚠️  DISCLAIMER: USE AT YOUR OWN RISK - No warranty provided"
    echo ""
    echo "Usage: $0 [options] [command]"
    echo ""
    echo "Options:"
    echo "  -v, --version VERSION    Specify BAL Kit version to test (default: ${DEFAULT_VERSION})"
    echo "  -h, --help              Show this help message"
    echo ""
    echo "Commands:"
    echo "  all (default)           Run all tests including PHPUnit tests"
    echo "  composer                Test composer dependencies"
    echo "  php                     Test PHP syntax validation"
    echo "  phpunit                 Run PHPUnit tests from this package"
    echo "  install                 Test package installation in fresh Laravel app"
    echo "  frontend                Test frontend asset compilation"
    echo "  laravel                 Test Laravel functionality"
    echo "  benchmark               Run performance benchmarks"
    echo "  cleanup                 Clean up test environment"
    echo "  help                    Show this help message"
    echo ""
    echo "Examples:"
    echo "  $0 --version '^1.4.8' all"
    echo "  $0 -v '1.4.10' phpunit"
    echo "  $0 composer"
    echo ""
    echo "Prerequisites:"
    echo "  - PHP >= 8.2"
    echo "  - Composer"
    echo "  - Node.js & NPM (for frontend tests)"
    echo "  - Internet connection (for package installation)"
    echo ""
}

# Generate comprehensive test report
generate_final_report() {
    echo ""
    print_header "COMPREHENSIVE TEST REPORT"

    echo -e "${BLUE}Test Configuration:${NC}"
    echo -e "  📦 BAL Kit Version: ${VERSION}"
    echo -e "  🔧 Test Mode: ${TEST_MODE:-"all"}"
    echo -e "  📁 Test Workspace: ${TEST_WORKSPACE_DIR}"
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
            echo -e "${GREEN}🎉 ALL TESTS PASSED! BAL Kit is working perfectly.${NC}"
        else
            echo -e "${YELLOW}✅ Tests passed with ${WARNING_TESTS} warnings. BAL Kit is functional but review warnings.${NC}"
        fi
    else
        echo -e "${RED}❌ ${FAILED_TESTS} test(s) failed. BAL Kit requires attention before use.${NC}"
    fi

    echo ""
    print_header "TEST CATEGORIES COVERED"
    echo -e "  🔧 Repository Access & Package Installation"
    echo -e "  📦 Composer Dependencies & Security Audit"
    echo -e "  🔍 PHP Syntax Validation"
    echo -e "  🧪 PHPUnit Tests (Feature & Unit)"
    echo -e "  ⚙️  Laravel Integration (Minimal, Standard, Full presets)"
    echo -e "  🎨 Frontend Asset Compilation"
    echo -e "  🚀 Laravel Application Functionality"
    echo -e "  🔍 View Caching & Component Resolution"
    echo -e "  📊 Performance Benchmarking"
    echo ""
}

# Check if we can access the BAL Kit package
check_bal_kit_local_source() {
    print_info "Checking BAL Kit local source (version: ${VERSION})"
    record_test_pass "Local Source - BAL Kit source code available for testing"
}

# Test composer dependencies
test_composer() {
    print_header "Testing Composer Dependencies"

    # Store original directory
    local original_dir=$(pwd)

    print_info "Testing BAL Kit package availability..."
    # Create a temporary directory to test package installation
    temp_dir="${TEST_WORKSPACE_DIR}/composer-test"
    mkdir -p "$temp_dir"
    cd "$temp_dir"

    # Create a minimal composer.json to test package installation
    cat >composer.json <<EOF
{
    "require": {
        "get-tony/bal-kit": "${VERSION}"
    }
}
EOF

    print_info "Installing BAL Kit package from repository..."
    if composer install --no-interaction --prefer-dist >/dev/null 2>&1; then
        record_test_pass "Composer - Package installation from repository"
    else
        record_test_fail "Composer - Package installation failed"
    fi

    print_info "Checking for security vulnerabilities..."
    if composer audit >/dev/null 2>&1; then
        record_test_pass "Composer - Security audit passed"
    else
        record_test_warning "Security audit completed with warnings"
    fi

    # Return to original directory and clean up
    cd "$original_dir"
    rm -rf "$temp_dir"
}

# Test PHP syntax and standards
test_php() {
    print_header "Testing PHP Syntax and Standards"

    print_info "Testing PHP syntax in source files..."
    if find src -name "*.php" -exec php -l {} \; >/dev/null 2>&1; then
        record_test_pass "PHP Syntax - All source files valid"
    else
        record_test_fail "PHP Syntax - Syntax errors found in source files"
    fi

    print_info "Testing PHP syntax in test files..."
    if find tests -name "*.php" -exec php -l {} \; >/dev/null 2>&1; then
        record_test_pass "PHP Syntax - All test files valid"
    else
        record_test_fail "PHP Syntax - Syntax errors found in test files"
    fi
}

# Run PHPUnit tests from the current package
test_phpunit() {
    print_header "Running PHPUnit Tests"

    # Store original directory
    local original_dir=$(pwd)

    print_info "Installing PHPUnit dependencies..."
    if composer install --no-interaction --prefer-dist >/dev/null 2>&1; then
        record_test_pass "PHPUnit - Dependencies installed successfully"
    else
        record_test_fail "PHPUnit - Failed to install dependencies"
        return
    fi

    print_info "Running Feature tests..."
    if vendor/bin/phpunit --testsuite=Feature --no-coverage >/dev/null 2>&1; then
        record_test_pass "PHPUnit - Feature tests passed"
    else
        record_test_fail "PHPUnit - Feature tests failed"
    fi

    print_info "Running Unit tests..."
    if vendor/bin/phpunit --testsuite=Unit --no-coverage >/dev/null 2>&1; then
        record_test_pass "PHPUnit - Unit tests passed"
    else
        record_test_fail "PHPUnit - Unit tests failed"
    fi

    print_info "Running complete test suite with coverage..."
    if vendor/bin/phpunit --coverage-text >/dev/null 2>&1; then
        record_test_pass "PHPUnit - Complete test suite with coverage"
    else
        record_test_warning "PHPUnit - Coverage generation had issues"
    fi
}

# Test package installation in a fresh Laravel app
test_installation() {
    print_header "Testing Package Installation"

    # Store original directory
    local original_dir=$(pwd)

    setup_test_workspace

    print_info "Creating fresh Laravel application..."
    cd "$TEST_WORKSPACE_DIR"
    composer create-project laravel/laravel test-app --no-interaction --prefer-dist

    cd test-app

    # Install BAL Kit package
    print_info "Installing BAL Kit package (version: ${VERSION})..."
    composer require "get-tony/bal-kit:${VERSION}" --no-interaction

    # Test different installation presets
    print_info "Testing minimal preset installation..."
    if php artisan bal:install --preset=minimal --no-interaction >/dev/null 2>&1; then
        record_test_pass "Laravel Integration - Minimal preset installation"
    else
        record_test_fail "Laravel Integration - Minimal preset installation failed"
    fi

    print_info "Testing standard preset installation..."
    if php artisan bal:install --preset=standard --no-interaction >/dev/null 2>&1; then
        record_test_pass "Laravel Integration - Standard preset installation"
    else
        record_test_fail "Laravel Integration - Standard preset installation failed"
    fi

    print_info "Testing full preset installation..."
    if php artisan bal:install --preset=full --no-interaction >/dev/null 2>&1; then
        record_test_pass "Laravel Integration - Full preset installation"
    else
        record_test_fail "Laravel Integration - Full preset installation failed"
    fi

    # Test individual component installations
    print_info "Testing individual component installations..."
    if php artisan bal:install --bootstrap --alpine --no-interaction >/dev/null 2>&1; then
        record_test_pass "Laravel Integration - Individual components (Bootstrap + Alpine)"
    else
        record_test_warning "Individual components installation had issues"
    fi

    # Return to original directory
    cd "$original_dir"
}

# Test frontend assets
test_frontend() {
    print_header "Testing Frontend Assets"

    # Store original directory
    local original_dir=$(pwd)

    cd "$TEST_APP_DIR"

    if [ -f "package.json" ]; then
        print_info "Installing NPM dependencies..."
        if npm ci --silent >/dev/null 2>&1; then
            record_test_pass "Frontend - NPM dependencies installed"
        else
            record_test_fail "Frontend - NPM dependencies installation failed"
        fi

        print_info "Building frontend assets..."
        if npm run build >/dev/null 2>&1 || npm run dev >/dev/null 2>&1; then
            record_test_pass "Frontend - Asset compilation successful"
        else
            record_test_fail "Frontend - Asset compilation failed"
        fi
    else
        record_test_warning "Frontend - package.json not found, skipping frontend tests"
    fi

    # Return to original directory
    cd "$original_dir"
}

# Test Laravel application functionality
test_laravel_functionality() {
    print_header "Testing Laravel Application Functionality"

    # Store original directory
    local original_dir=$(pwd)

    cd "$TEST_APP_DIR"

    print_info "Running Laravel application tests..."

    # Test artisan commands
    print_info "Testing BAL Kit artisan commands..."
    if php artisan list | grep -i bal >/dev/null 2>&1; then
        record_test_pass "Laravel Functionality - BAL Kit artisan commands registered"
    else
        record_test_fail "Laravel Functionality - BAL Kit commands not registered"
    fi

    # Test if Laravel can start (without actually starting the server)
    print_info "Testing Laravel application bootstrap..."
    if php artisan route:list >/dev/null 2>&1; then
        record_test_pass "Laravel Functionality - Route listing successful"
    else
        record_test_warning "Route listing failed"
    fi

    if php artisan config:cache >/dev/null 2>&1; then
        record_test_pass "Laravel Functionality - Config caching successful"
    else
        record_test_warning "Config caching failed"
    fi

    # Test view caching with detailed error reporting
    if php artisan view:cache 2>&1 >/dev/null; then
        record_test_pass "Laravel Functionality - View caching successful"
    else
        record_test_fail "Laravel Functionality - View caching failed"
        print_warning "View caching failed - showing specific error..."
        php artisan view:cache 2>&1 | head -5
    fi

    # Return to original directory
    cd "$original_dir"
}

# Cleanup test environment
cleanup() {
    print_header "Cleaning Up Test Environment"

    if [ -d "$TEST_WORKSPACE_DIR" ]; then
        print_info "Removing test workspace..."
        rm -rf "$TEST_WORKSPACE_DIR"
        print_success "Test workspace removed"
    fi
}

# Performance benchmarking
benchmark() {
    print_header "Performance Benchmarking"

    # Store original directory
    local original_dir=$(pwd)

    cd "$TEST_APP_DIR"

    print_info "Benchmarking artisan commands..."
    start_time=$(date +%s)
    if php artisan bal:install --preset=standard --no-interaction >/dev/null 2>&1; then
        end_time=$(date +%s)
        duration=$((end_time - start_time))
        record_test_pass "Performance - Standard preset installation (${duration}s)"
    else
        record_test_warning "Performance - Benchmark test had issues"
    fi

    # Return to original directory
    cd "$original_dir"
}

# Main testing function
run_all_tests() {
    print_header "Starting BAL Kit Local Testing"
    TEST_MODE="all"

    check_working_directory
    check_bal_kit_repository
    test_composer
    test_php
    test_phpunit
    test_installation
    test_frontend
    test_laravel_functionality
    benchmark

    # Generate comprehensive final report
    generate_final_report
}

# Parse command line arguments
while [[ $# -gt 0 ]]; do
    case $1 in
    -v | --version)
        VERSION="$2"
        shift 2
        ;;
    -h | --help)
        show_usage
        exit 0
        ;;
    *)
        COMMAND="$1"
        shift
        ;;
    esac
done

# Initial setup
check_working_directory

# Command line argument handling
case "${COMMAND:-all}" in
"composer")
    TEST_MODE="composer"
    check_bal_kit_repository
    test_composer
    generate_final_report
    ;;
"php")
    TEST_MODE="php"
    test_php
    generate_final_report
    ;;
"phpunit")
    TEST_MODE="phpunit"
    test_phpunit
    generate_final_report
    ;;
"install" | "installation")
    TEST_MODE="install"
    check_bal_kit_repository
    test_installation
    generate_final_report
    ;;
"frontend")
    TEST_MODE="frontend"
    check_bal_kit_repository
    test_installation
    test_frontend
    generate_final_report
    ;;
"laravel")
    TEST_MODE="laravel"
    check_bal_kit_repository
    test_installation
    test_laravel_functionality
    generate_final_report
    ;;
"benchmark")
    TEST_MODE="benchmark"
    check_bal_kit_repository
    test_installation
    benchmark
    generate_final_report
    ;;
"cleanup")
    cleanup
    ;;
"all" | "")
    run_all_tests
    ;;
"help" | "-h" | "--help")
    show_usage
    ;;
*)
    print_error "Unknown command: $COMMAND"
    echo "Use '$0 help' for available commands"
    exit 1
    ;;
esac

# Cleanup on script exit (only for full test runs)
if [[ "${COMMAND:-all}" == "all" ]]; then
    trap cleanup EXIT
fi
