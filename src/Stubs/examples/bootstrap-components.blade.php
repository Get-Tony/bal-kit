<x-app-layout>
    <x-slot name="title">Bootstrap Components</x-slot>

    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">Bootstrap Components</h1>
                <p class="text-muted mb-0">Comprehensive showcase of Bootstrap 5.3+ components available in BAL Kit</p>
            </div>
        </div>

        <!-- Table of Contents -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Table of Contents</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <ul class="list-unstyled">
                                    <li><a href="#alerts" class="text-decoration-none">Alerts</a></li>
                                    <li><a href="#badges" class="text-decoration-none">Badges</a></li>
                                    <li><a href="#buttons" class="text-decoration-none">Buttons</a></li>
                                    <li><a href="#cards" class="text-decoration-none">Cards</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul class="list-unstyled">
                                    <li><a href="#forms" class="text-decoration-none">Forms</a></li>
                                    <li><a href="#modals" class="text-decoration-none">Modals</a></li>
                                    <li><a href="#navigation" class="text-decoration-none">Navigation</a></li>
                                    <li><a href="#progress" class="text-decoration-none">Progress</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul class="list-unstyled">
                                    <li><a href="#tables" class="text-decoration-none">Tables</a></li>
                                    <li><a href="#tooltips" class="text-decoration-none">Tooltips</a></li>
                                    <li><a href="#typography" class="text-decoration-none">Typography</a></li>
                                    <li><a href="#utilities" class="text-decoration-none">Utilities</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul class="list-unstyled">
                                    <li><a href="#spinners" class="text-decoration-none">Spinners</a></li>
                                    <li><a href="#accordion" class="text-decoration-none">Accordion</a></li>
                                    <li><a href="#offcanvas" class="text-decoration-none">Offcanvas</a></li>
                                    <li><a href="#dropdowns" class="text-decoration-none">Dropdowns</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerts Section -->
        <div class="row mb-4" id="alerts">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Alerts</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            A simple primary alert—check it out!
                        </div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Well done!</strong> You successfully read this important alert message.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <h6 class="alert-heading">Warning!</h6>
                            This is a warning alert with a heading. It has some additional context.
                        </div>
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-times-circle me-2"></i>
                            A simple danger alert—check it out!
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="row mb-4" id="buttons">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Buttons</h6>
                    </div>
                    <div class="card-body">
                        <h6>Basic Buttons</h6>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary me-2">Primary</button>
                            <button type="button" class="btn btn-secondary me-2">Secondary</button>
                            <button type="button" class="btn btn-success me-2">Success</button>
                            <button type="button" class="btn btn-danger me-2">Danger</button>
                            <button type="button" class="btn btn-warning me-2">Warning</button>
                            <button type="button" class="btn btn-info me-2">Info</button>
                        </div>

                        <h6>Outline Buttons</h6>
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-primary me-2">Primary</button>
                            <button type="button" class="btn btn-outline-secondary me-2">Secondary</button>
                            <button type="button" class="btn btn-outline-success me-2">Success</button>
                            <button type="button" class="btn btn-outline-danger me-2">Danger</button>
                        </div>

                        <h6>Button Sizes</h6>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary btn-lg me-2">Large</button>
                            <button type="button" class="btn btn-primary me-2">Default</button>
                            <button type="button" class="btn btn-primary btn-sm me-2">Small</button>
                        </div>

                        <h6>Buttons with Icons</h6>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary me-2">
                                <i class="fas fa-download me-2"></i>Download
                            </button>
                            <button type="button" class="btn btn-success me-2">
                                <i class="fas fa-save me-2"></i>Save
                            </button>
                            <button type="button" class="btn btn-danger me-2">
                                <i class="fas fa-trash me-2"></i>Delete
                            </button>
                            <button type="button" class="btn btn-info">
                                <i class="fas fa-cog"></i>
                            </button>
                        </div>

                        <h6>Button States</h6>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary me-2" disabled>Disabled</button>
                            <button type="button" class="btn btn-primary me-2">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards Section -->
        <div class="row mb-4" id="cards">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cards</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        Basic Card
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title.</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        Primary Card
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Primary card title</h5>
                                        <p class="card-text">Some example text with primary border.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card text-center">
                                    <div class="card-header">
                                        Centered Card
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Special title treatment</h5>
                                        <p class="card-text">With supporting text below as a natural lead-in.</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                        2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Forms Section -->
        <div class="row mb-4" id="forms">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Forms</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="select" class="form-label">Select</label>
                                    <select class="form-select" id="select">
                                        <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="range" class="form-label">Range</label>
                                    <input type="range" class="form-range" id="range">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="textarea" class="form-label">Example textarea</label>
                                <textarea class="form-control" id="textarea" rows="3"></textarea>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox">
                                    <label class="form-check-label" for="checkbox">
                                        Check me out
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio" id="radio1" value="option1" checked>
                                    <label class="form-check-label" for="radio1">
                                        Default radio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio" id="radio2" value="option2">
                                    <label class="form-check-label" for="radio2">
                                        Second default radio
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="switch">
                                    <label class="form-check-label" for="switch">Switch</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tables Section -->
        <div class="row mb-4" id="tables">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tables</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>Bird</td>
                                        <td>@twitter</td>
                                        <td><span class="badge bg-secondary">Inactive</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Section -->
        <div class="row mb-4" id="progress">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Progress Bars</h6>
                    </div>
                    <div class="card-body">
                        <h6>Basic Progress</h6>
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <h6>With Labels</h6>
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                        </div>

                        <h6>Colored Progress</h6>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        <h6>Striped & Animated</h6>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Badges Section -->
        <div class="row mb-4" id="badges">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Badges</h6>
                    </div>
                    <div class="card-body">
                        <h6>Basic Badges</h6>
                        <div class="mb-3">
                            <span class="badge bg-primary me-2">Primary</span>
                            <span class="badge bg-secondary me-2">Secondary</span>
                            <span class="badge bg-success me-2">Success</span>
                            <span class="badge bg-danger me-2">Danger</span>
                            <span class="badge bg-warning text-dark me-2">Warning</span>
                            <span class="badge bg-info text-dark me-2">Info</span>
                            <span class="badge bg-light text-dark me-2">Light</span>
                            <span class="badge bg-dark">Dark</span>
                        </div>

                        <h6>Pill Badges</h6>
                        <div class="mb-3">
                            <span class="badge rounded-pill bg-primary me-2">Primary</span>
                            <span class="badge rounded-pill bg-secondary me-2">Secondary</span>
                            <span class="badge rounded-pill bg-success me-2">Success</span>
                            <span class="badge rounded-pill bg-danger">Danger</span>
                        </div>

                        <h6>Positioned Badges</h6>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary position-relative me-3">
                                Inbox
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    99+
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-secondary position-relative">
                                Profile
                                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spinners Section -->
        <div class="row mb-4" id="spinners">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Spinners</h6>
                    </div>
                    <div class="card-body">
                        <h6>Border Spinners</h6>
                        <div class="mb-3">
                            <div class="spinner-border text-primary me-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-border text-success me-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-border text-warning me-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <h6>Growing Spinners</h6>
                        <div class="mb-3">
                            <div class="spinner-grow text-primary me-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-grow text-success me-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-grow text-warning me-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <h6>Size Variants</h6>
                        <div class="mb-3">
                            <div class="spinner-border spinner-border-sm text-primary me-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="spinner-border text-primary me-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accordion Section -->
        <div class="row mb-4" id="accordion">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Accordion</h6>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Accordion Item #1
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Accordion Item #2
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals Section -->
        <div class="row mb-4" id="modals">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Modals</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                                    Basic Modal
                                </button>
                            </div>
                            <div class="col-md-3 mb-2">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#largeModal">
                                    Large Modal
                                </button>
                            </div>
                            <div class="col-md-3 mb-2">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#centeredModal">
                                    Centered Modal
                                </button>
                            </div>
                            <div class="col-md-3 mb-2">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#scrollableModal">
                                    Scrollable Modal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Section -->
        <div class="row mb-4" id="navigation">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Navigation</h6>
                    </div>
                    <div class="card-body">
                        <h6>Basic Tabs</h6>
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-content" type="button" role="tab" aria-controls="profile-content" aria-selected="false">Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                This is the home tab content.
                            </div>
                            <div class="tab-pane fade" id="profile-content" role="tabpanel" aria-labelledby="profile-tab">
                                This is the profile tab content.
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                This is the contact tab content.
                            </div>
                        </div>

                        <h6 class="mt-4">Pills Navigation</h6>
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Active</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Typography Section -->
        <div class="row mb-4" id="typography">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Typography</h6>
                    </div>
                    <div class="card-body">
                        <h1>h1. Bootstrap heading</h1>
                        <h2>h2. Bootstrap heading</h2>
                        <h3>h3. Bootstrap heading</h3>
                        <h4>h4. Bootstrap heading</h4>
                        <h5>h5. Bootstrap heading</h5>
                        <h6>h6. Bootstrap heading</h6>

                        <hr>

                        <p class="lead">This is a lead paragraph. It stands out from regular paragraphs.</p>
                        <p>This is a regular paragraph with <strong>bold text</strong>, <em>italic text</em>, and <u>underlined text</u>.</p>
                        <p class="text-muted">This is muted text.</p>
                        <p class="text-primary">This is primary text.</p>
                        <p class="text-success">This is success text.</p>
                        <p class="text-warning">This is warning text.</p>
                        <p class="text-danger">This is danger text.</p>

                        <blockquote class="blockquote">
                            <p class="mb-0">A well-known quote, contained in a blockquote element.</p>
                            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Basic Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="basicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="basicModalLabel">Basic Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    This is a basic modal example with header, body, and footer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Large Modal -->
    <div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Large Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    This is a large modal with more space for content.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Centered Modal -->
    <div class="modal fade" id="centeredModal" tabindex="-1" aria-labelledby="centeredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="centeredModalLabel">Centered Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    This modal is vertically centered.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scrollable Modal -->
    <div class="modal fade" id="scrollableModal" tabindex="-1" aria-labelledby="scrollableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalLabel">Scrollable Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>This is some placeholder content to show the scrolling behavior for modals.</p>
                    <p>We use repeated line breaks to demonstrate how content can exceed the modal's boundaries.</p>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <p>This content should appear at the bottom after scrolling.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    @endpush
</x-app-layout>
