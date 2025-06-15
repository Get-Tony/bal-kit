<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <p class="text-muted mb-0">Welcome back, {{ auth()->user()->name ?? 'User' }}!</p>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newItemModal">
                            <i class="fas fa-plus me-2"></i>New Item
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Revenue (Monthly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Orders
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">215</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                 style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Direct
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Social
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Referral
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Recent Activity -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">New order received</div>
                                    <small class="text-muted">Order #12345 from John Doe</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">2m ago</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">User registration</div>
                                    <small class="text-muted">New user jane@example.com registered</small>
                                </div>
                                <span class="badge bg-success rounded-pill">5m ago</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Payment processed</div>
                                    <small class="text-muted">$299.99 payment from Order #12344</small>
                                </div>
                                <span class="badge bg-info rounded-pill">12m ago</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">System backup completed</div>
                                    <small class="text-muted">Database backup successful</small>
                                </div>
                                <span class="badge bg-secondary rounded-pill">1h ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Performing -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Top Performing Products</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Sales</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-laptop text-white"></i>
                                                </div>
                                                Laptop Pro
                                            </div>
                                        </td>
                                        <td>45</td>
                                        <td class="text-success">$13,500</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-success rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-mobile-alt text-white"></i>
                                                </div>
                                                Smartphone X
                                            </div>
                                        </td>
                                        <td>38</td>
                                        <td class="text-success">$11,400</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-info rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-headphones text-white"></i>
                                                </div>
                                                Wireless Headphones
                                            </div>
                                        </td>
                                        <td>29</td>
                                        <td class="text-success">$2,900</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-warning rounded-circle me-2 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-tablet-alt text-white"></i>
                                                </div>
                                                Tablet Plus
                                            </div>
                                        </td>
                                        <td>22</td>
                                        <td class="text-success">$6,600</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="card bg-primary text-white shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-users fa-2x"></i>
                                            <div class="ms-3">
                                                <div class="text-white-50 small">Manage</div>
                                                <div class="text-white">Users</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="card bg-success text-white shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-cog fa-2x"></i>
                                            <div class="ms-3">
                                                <div class="text-white-50 small">System</div>
                                                <div class="text-white">Settings</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="card bg-info text-white shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-chart-bar fa-2x"></i>
                                            <div class="ms-3">
                                                <div class="text-white-50 small">View</div>
                                                <div class="text-white">Reports</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="card bg-warning text-white shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-envelope fa-2x"></i>
                                            <div class="ms-3">
                                                <div class="text-white-50 small">Send</div>
                                                <div class="text-white">Messages</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Item Modal -->
    <div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newItemModalLabel">Create New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="itemName" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="itemName" required>
                        </div>
                        <div class="mb-3">
                            <label for="itemDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="itemDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="itemCategory" class="form-label">Category</label>
                            <select class="form-select" id="itemCategory" required>
                                <option value="">Select Category</option>
                                <option value="electronics">Electronics</option>
                                <option value="clothing">Clothing</option>
                                <option value="books">Books</option>
                                <option value="home">Home & Garden</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="itemPrice" class="form-label">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="itemPrice" step="0.01" min="0">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Create Item</button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .border-left-primary {
            border-left: .25rem solid #4e73df !important;
        }
        .border-left-success {
            border-left: .25rem solid #1cc88a !important;
        }
        .border-left-info {
            border-left: .25rem solid #36b9cc !important;
        }
        .border-left-warning {
            border-left: .25rem solid #f6c23e !important;
        }
        .avatar-sm {
            width: 2.5rem;
            height: 2.5rem;
        }
        .text-gray-300 {
            color: #dddfeb !important;
        }
        .text-gray-800 {
            color: #5a5c69 !important;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Chart.js integration would go here
        // Example placeholder for actual chart implementation
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Dashboard loaded - charts would be initialized here');
        });
    </script>
    @endpush
</x-app-layout>
