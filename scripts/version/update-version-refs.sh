#!/bin/bash

# BAL Kit Version Reference Updater
# This script updates version references in documentation files
# using the centralized Version class as the source of truth.

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Helper functions
print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_info() {
    echo -e "${BLUE}ℹ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

# Get version information from centralized source
get_version_info() {
    SCRIPT_DIR="$(dirname "$0")"
    VERSION_SCRIPT="$SCRIPT_DIR/version.php"

    if [ ! -f "$VERSION_SCRIPT" ]; then
        print_error "Version helper not found at: $VERSION_SCRIPT"
        exit 1
    fi

    VERSION=$(php "$VERSION_SCRIPT" version)
    CONSTRAINT=$(php "$VERSION_SCRIPT" constraint)
    CODENAME=$(php "$VERSION_SCRIPT" codename)
    RELEASE_DATE=$(php "$VERSION_SCRIPT" date)

    print_info "Current version: $VERSION"
    print_info "Constraint: $CONSTRAINT"
    print_info "Codename: $CODENAME"
    print_info "Release date: $RELEASE_DATE"
}

# Update README.md
update_readme() {
    print_info "Updating README.md..."

    # Update version badge
    sed -i "s|Version-[0-9]\+\.[0-9]\+\.[0-9]\+%20Stable|Version-${VERSION}%20Stable|g" README.md
    sed -i "s|releases/tag/v[0-9]\+\.[0-9]\+\.[0-9]\+|releases/tag/v${VERSION}|g" README.md

    # Update version header
    sed -i "s|Version [0-9]\+\.[0-9]\+\.[0-9]\+ -|Version ${VERSION} -|g" README.md

    # Update starter kit version reference
    sed -i "s|(v[0-9]\+\.[0-9]\+\.[0-9]\+ Stable)|(v${VERSION} Stable)|g" README.md

    print_success "README.md updated"
}

# Update CHANGELOG.md
update_changelog() {
    print_info "Updating CHANGELOG.md..."

    # Check if current version entry exists
    if grep -q "## \[${VERSION}\]" CHANGELOG.md; then
        print_info "Version ${VERSION} already exists in CHANGELOG.md"
    else
        print_warning "Version ${VERSION} not found in CHANGELOG.md - manual update may be needed"
    fi

    print_success "CHANGELOG.md checked"
}

# Update docker-compose.test.yml default
update_docker_compose() {
    print_info "Updating docker-compose.test.yml..."

    sed -i "s|BAL_KIT_VERSION:-\^[0-9]\+\.[0-9]\+\.[0-9]\+|BAL_KIT_VERSION:-${CONSTRAINT}|g" scripts/docker/docker-compose.test.yml

    print_success "docker-compose.test.yml updated"
}

# Main function
main() {
    echo -e "${BLUE}========================================${NC}"
    echo -e "${BLUE}BAL Kit Version Reference Updater${NC}"
    echo -e "${BLUE}========================================${NC}"

    get_version_info
    echo ""

    update_readme
    update_changelog
    update_docker_compose

    echo ""
    echo -e "${GREEN}========================================${NC}"
    echo -e "${GREEN}Version references updated successfully!${NC}"
    echo -e "${GREEN}========================================${NC}"
    echo ""
    echo -e "${BLUE}Summary:${NC}"
    echo -e "  Version: ${VERSION}"
    echo -e "  Constraint: ${CONSTRAINT}"
    echo -e "  Codename: ${CODENAME}"
    echo -e "  Release Date: ${RELEASE_DATE}"
    echo ""
    echo -e "${YELLOW}Note: Test scripts will automatically use the centralized version.${NC}"
    echo -e "${YELLOW}No manual updates needed for testing scripts.${NC}"
}

# Run main function
main "$@"
