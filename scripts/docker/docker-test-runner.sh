#!/bin/bash

# ===================================================================
# BAL Kit Docker Test Runner
# ===================================================================
#
# This script provides an easy way to run BAL Kit tests in Docker
# for complete isolation from your local environment.
#
# DISCLAIMER: USE AT YOUR OWN RISK
# This script is provided "AS IS" without warranty of any kind.
#
# ===================================================================

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Default configuration - get version from centralized source
DEFAULT_VERSION=$(php "$(dirname "$0")/../version/version.php" constraint 2>/dev/null || echo "^1.5.0")
VERSION="${DEFAULT_VERSION}"
BUILD_CACHE="true"

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

# Check prerequisites
check_prerequisites() {
    print_info "Checking Docker prerequisites..."

    if ! command -v docker >/dev/null 2>&1; then
        echo -e "${RED}❌ ERROR: Docker is not installed or not in PATH${NC}"
        echo -e "${RED}   Please install Docker first: https://docs.docker.com/get-docker/${NC}"
        exit 1
    fi

    if ! command -v docker-compose >/dev/null 2>&1 && ! docker compose version >/dev/null 2>&1; then
        echo -e "${RED}❌ ERROR: Docker Compose is not available${NC}"
        echo -e "${RED}   Please install Docker Compose or use a newer Docker with built-in compose${NC}"
        exit 1
    fi

    # Check if Docker daemon is running
    if ! docker info >/dev/null 2>&1; then
        echo -e "${RED}❌ ERROR: Docker daemon is not running${NC}"
        echo -e "${RED}   Please start Docker first${NC}"
        exit 1
    fi

    print_success "Docker prerequisites satisfied"
}

# Check working directory
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

    print_success "Working directory validated"
}

# Show usage information
show_usage() {
    echo "BAL Kit Docker Test Runner"
    echo ""
    echo "🐳 Runs BAL Kit tests in complete Docker isolation"
    echo ""
    echo "⚠️  DISCLAIMER: USE AT YOUR OWN RISK - No warranty provided"
    echo ""
    echo "Usage: $0 [options] [command]"
    echo ""
    echo "Options:"
    echo "  -v, --version VERSION    Specify BAL Kit version to test (default: ${DEFAULT_VERSION})"
    echo "  --no-cache              Disable Docker build cache"
    echo "  -h, --help              Show this help message"
    echo ""
    echo "Commands:"
    echo "  all (default)           Run all tests in Docker"
    echo "  composer                Test composer dependencies"
    echo "  php                     Test PHP syntax validation"
    echo "  phpunit                 Run PHPUnit tests"
    echo "  install                 Test Laravel integration"
    echo "  frontend                Test frontend assets"
    echo "  build                   Build Docker image only"
    echo "  clean                   Clean up Docker resources"
    echo "  shell                   Open interactive shell in test container"
    echo ""
    echo "Examples:"
    echo "  $0                                    # Run all tests"
    echo "  $0 --version '1.4.8' all            # Test specific version"
    echo "  $0 phpunit                           # Run only PHPUnit tests"
    echo "  $0 shell                             # Interactive debugging"
    echo "  $0 clean                             # Clean up afterwards"
    echo ""
    echo "Docker Benefits:"
    echo "  🔒 Complete isolation from your local environment"
    echo "  🛡️  No risk to your local PHP/Composer/Node setup"
    echo "  📏 Consistent testing environment across systems"
    echo "  🔄 Reproducible results"
    echo ""
    echo "Prerequisites:"
    echo "  - Docker (https://docs.docker.com/get-docker/)"
    echo "  - Docker Compose or Docker with built-in compose"
    echo "  - Internet connection (for package installation)"
    echo ""
}

# Build Docker image
build_docker_image() {
    print_header "Building Docker Test Environment"

    local build_args=""
    if [ "$BUILD_CACHE" = "false" ]; then
        build_args="--no-cache"
    fi

    print_info "Building Docker image for BAL Kit testing..."
    if docker build $build_args -f scripts/docker/Dockerfile.testing -t bal-kit-test . >/dev/null 2>&1; then
        print_success "Docker image built successfully"
    else
        print_error "Failed to build Docker image"
        echo -e "${RED}   Try running with --no-cache flag${NC}"
        exit 1
    fi
}

# Run tests in Docker
run_docker_tests() {
    local test_command="${1:-all}"

    print_header "Running Tests in Docker Container"

    # Determine compose command
    local compose_cmd="docker-compose"
    if ! command -v docker-compose >/dev/null 2>&1; then
        compose_cmd="docker compose"
    fi

    # Set environment variables for docker-compose
    export BAL_KIT_VERSION="$VERSION"
    export TEST_COMMAND="$test_command"

    print_info "Starting Docker container with command: $test_command"
    print_info "BAL Kit version: $VERSION"

    # Run the tests
    if $compose_cmd -f scripts/docker/docker-compose.test.yml run --rm bal-kit-test; then
        print_success "Docker tests completed successfully"
    else
        print_error "Docker tests failed"
        exit 1
    fi
}

# Open interactive shell
open_shell() {
    print_header "Opening Interactive Shell in Docker Container"

    # Determine compose command
    local compose_cmd="docker-compose"
    if ! command -v docker-compose >/dev/null 2>&1; then
        compose_cmd="docker compose"
    fi

    export BAL_KIT_VERSION="$VERSION"

    print_info "Opening interactive bash shell..."
    print_info "You can run ./docker-test.sh commands manually inside the container"

    $compose_cmd -f scripts/docker/docker-compose.test.yml run --rm bal-kit-test bash
}

# Clean up Docker resources
clean_docker() {
    print_header "Cleaning Up Docker Resources"

    # Determine compose command
    local compose_cmd="docker-compose"
    if ! command -v docker-compose >/dev/null 2>&1; then
        compose_cmd="docker compose"
    fi

    print_info "Stopping and removing containers..."
    $compose_cmd -f scripts/docker/docker-compose.test.yml down --volumes --remove-orphans >/dev/null 2>&1 || true

    print_info "Removing Docker image..."
    docker rmi bal-kit-test >/dev/null 2>&1 || true

    print_info "Pruning unused volumes..."
    docker volume prune -f >/dev/null 2>&1 || true

    print_success "Docker cleanup completed"
}

# Parse command line arguments
while [[ $# -gt 0 ]]; do
    case $1 in
    -v | --version)
        VERSION="$2"
        shift 2
        ;;
    --no-cache)
        BUILD_CACHE="false"
        shift
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

# Initial checks
check_prerequisites
check_working_directory

# Handle commands
case "${COMMAND:-all}" in
"build")
    build_docker_image
    ;;
"clean")
    clean_docker
    ;;
"shell")
    build_docker_image
    open_shell
    ;;
"composer" | "php" | "phpunit" | "install" | "frontend" | "all" | "")
    build_docker_image
    run_docker_tests "${COMMAND:-all}"
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
