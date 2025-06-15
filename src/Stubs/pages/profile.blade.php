<x-app-layout>
    <x-slot name="title">Profile Settings</x-slot>

    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0 text-gray-800">Profile Settings</h1>
                        <p class="text-muted mb-0">Manage your account settings and preferences</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <div class="position-relative d-inline-block mb-3">
                            <img src="https://via.placeholder.com/120x120/4e73df/ffffff?text=U"
                                 class="rounded-circle img-fluid" alt="Profile Picture" style="width: 120px; height: 120px;">
                            <button class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle"
                                    style="width: 32px; height: 32px;">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <h5 class="card-title">{{ auth()->user()->name ?? 'John Doe' }}</h5>
                        <p class="text-muted small">{{ auth()->user()->email ?? 'john@example.com' }}</p>
                        <span class="badge bg-success">Active</span>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="card shadow mt-4">
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="#profile" class="list-group-item list-group-item-action active" data-bs-toggle="tab">
                                <i class="fas fa-user me-2"></i>Profile Information
                            </a>
                            <a href="#account" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                                <i class="fas fa-cog me-2"></i>Account Settings
                            </a>
                            <a href="#security" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                                <i class="fas fa-shield-alt me-2"></i>Security
                            </a>
                            <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                                <i class="fas fa-bell me-2"></i>Notifications
                            </a>
                            <a href="#privacy" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                                <i class="fas fa-lock me-2"></i>Privacy
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-lg-9">
                <div class="tab-content">
                    <!-- Profile Information Tab -->
                    <div class="tab-pane fade show active" id="profile">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="first_name" class="form-label">First Name</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                                   id="first_name" name="first_name" value="{{ old('first_name', 'John') }}">
                                            @error('first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                                   id="last_name" name="last_name" value="{{ old('last_name', 'Doe') }}">
                                            @error('last_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email" value="{{ old('email', auth()->user()->email ?? 'john@example.com') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                                   id="phone" name="phone" value="{{ old('phone', '+1 (555) 123-4567') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                                   id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', '1990-01-01') }}">
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="timezone" class="form-label">Timezone</label>
                                            <select class="form-select @error('timezone') is-invalid @enderror" id="timezone" name="timezone">
                                                <option value="UTC">UTC</option>
                                                <option value="America/New_York" selected>Eastern Time (ET)</option>
                                                <option value="America/Chicago">Central Time (CT)</option>
                                                <option value="America/Denver">Mountain Time (MT)</option>
                                                <option value="America/Los_Angeles">Pacific Time (PT)</option>
                                                <option value="Europe/London">London (GMT)</option>
                                                <option value="Europe/Berlin">Berlin (CET)</option>
                                            </select>
                                            @error('timezone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="bio" class="form-label">Bio</label>
                                        <textarea class="form-control @error('bio') is-invalid @enderror"
                                                  id="bio" name="bio" rows="4" placeholder="Tell us a little about yourself...">{{ old('bio', 'Full-stack developer passionate about creating amazing web applications.') }}</textarea>
                                        @error('bio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Account Settings</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <h6 class="text-gray-900">Language & Region</h6>
                                        <div class="mb-3">
                                            <label for="language" class="form-label">Language</label>
                                            <select class="form-select" id="language" name="language">
                                                <option value="en" selected>English</option>
                                                <option value="es">Español</option>
                                                <option value="fr">Français</option>
                                                <option value="de">Deutsch</option>
                                                <option value="it">Italiano</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="currency" class="form-label">Currency</label>
                                            <select class="form-select" id="currency" name="currency">
                                                <option value="USD" selected>USD ($)</option>
                                                <option value="EUR">EUR (€)</option>
                                                <option value="GBP">GBP (£)</option>
                                                <option value="JPY">JPY (¥)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <h6 class="text-gray-900">Display Preferences</h6>
                                        <div class="mb-3">
                                            <label for="theme" class="form-label">Theme</label>
                                            <select class="form-select" id="theme" name="theme">
                                                <option value="light" selected>Light</option>
                                                <option value="dark">Dark</option>
                                                <option value="auto">Auto</option>
                                            </select>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="sidebar_collapsed" name="sidebar_collapsed">
                                            <label class="form-check-label" for="sidebar_collapsed">
                                                Collapse sidebar by default
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="show_tooltips" name="show_tooltips" checked>
                                            <label class="form-check-label" for="show_tooltips">
                                                Show helpful tooltips
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h6 class="text-gray-900 mb-3">Account Status</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title">Account Type</h6>
                                                <p class="card-text">Premium Account</p>
                                                <span class="badge bg-success">Active</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title">Member Since</h6>
                                                <p class="card-text">January 2024</p>
                                                <small class="text-muted">11 months ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Save Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Tab -->
                    <div class="tab-pane fade" id="security">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                               id="current_password" name="current_password" required>
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Use 8 or more characters with a mix of letters, numbers & symbols.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control"
                                               id="password_confirmation" name="password_confirmation" required>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-key me-2"></i>Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Two-Factor Authentication</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two-Factor Authentication</h6>
                                        <p class="text-muted mb-0">Add an extra layer of security to your account</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="two_factor_enabled">
                                        <label class="form-check-label" for="two_factor_enabled"></label>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Two-factor authentication is currently disabled. Enable it to secure your account.
                                </div>

                                <h6 class="mt-4 mb-3">Recent Security Activity</h6>
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="mb-1">Login from Chrome on Windows</h6>
                                                <p class="mb-1 text-muted small">IP: 192.168.1.100</p>
                                            </div>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="mb-1">Password changed</h6>
                                                <p class="mb-1 text-muted small">Password updated successfully</p>
                                            </div>
                                            <small class="text-muted">1 day ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Tab -->
                    <div class="tab-pane fade" id="notifications">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Notification Preferences</h6>
                            </div>
                            <div class="card-body">
                                <h6 class="text-gray-900 mb-3">Email Notifications</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="email_orders" checked>
                                            <label class="form-check-label" for="email_orders">
                                                <strong>Order Updates</strong><br>
                                                <small class="text-muted">Receive emails about your order status</small>
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="email_promotions">
                                            <label class="form-check-label" for="email_promotions">
                                                <strong>Promotions</strong><br>
                                                <small class="text-muted">Receive emails about sales and promotions</small>
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="email_newsletter" checked>
                                            <label class="form-check-label" for="email_newsletter">
                                                <strong>Newsletter</strong><br>
                                                <small class="text-muted">Weekly newsletter with updates</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="email_security" checked>
                                            <label class="form-check-label" for="email_security">
                                                <strong>Security Alerts</strong><br>
                                                <small class="text-muted">Important security notifications</small>
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="email_account" checked>
                                            <label class="form-check-label" for="email_account">
                                                <strong>Account Updates</strong><br>
                                                <small class="text-muted">Changes to your account</small>
                                            </label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="email_tips">
                                            <label class="form-check-label" for="email_tips">
                                                <strong>Tips & Tutorials</strong><br>
                                                <small class="text-muted">Helpful tips and how-to guides</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h6 class="text-gray-900 mb-3">Push Notifications</h6>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="push_enabled" checked>
                                    <label class="form-check-label" for="push_enabled">
                                        Enable push notifications
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="push_messages" checked>
                                    <label class="form-check-label" for="push_messages">
                                        New messages and mentions
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="push_updates">
                                    <label class="form-check-label" for="push_updates">
                                        Product updates and announcements
                                    </label>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Save Preferences
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Tab -->
                    <div class="tab-pane fade" id="privacy">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Privacy Settings</h6>
                            </div>
                            <div class="card-body">
                                <h6 class="text-gray-900 mb-3">Profile Visibility</h6>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="profile_visibility" id="profile_public" value="public">
                                    <label class="form-check-label" for="profile_public">
                                        <strong>Public</strong><br>
                                        <small class="text-muted">Anyone can see your profile</small>
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="profile_visibility" id="profile_friends" value="friends" checked>
                                    <label class="form-check-label" for="profile_friends">
                                        <strong>Friends Only</strong><br>
                                        <small class="text-muted">Only your connections can see your profile</small>
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="profile_visibility" id="profile_private" value="private">
                                    <label class="form-check-label" for="profile_private">
                                        <strong>Private</strong><br>
                                        <small class="text-muted">Only you can see your profile</small>
                                    </label>
                                </div>

                                <hr>

                                <h6 class="text-gray-900 mb-3">Data & Analytics</h6>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="analytics_tracking" checked>
                                    <label class="form-check-label" for="analytics_tracking">
                                        Allow analytics tracking
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="personalized_ads">
                                    <label class="form-check-label" for="personalized_ads">
                                        Show personalized advertisements
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="data_sharing">
                                    <label class="form-check-label" for="data_sharing">
                                        Share data with trusted partners
                                    </label>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Save Privacy Settings
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow border-danger">
                            <div class="card-header py-3 bg-danger text-white">
                                <h6 class="m-0 font-weight-bold">Danger Zone</h6>
                            </div>
                            <div class="card-body">
                                <h6 class="text-danger">Delete Account</h6>
                                <p class="text-muted mb-3">
                                    Once you delete your account, there is no going back. Please be certain.
                                </p>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                    <i class="fas fa-trash me-2"></i>Delete Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title text-danger" id="deleteAccountModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Delete Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <strong>Warning!</strong> This action cannot be undone.
                    </div>
                    <p>Are you sure you want to delete your account? This will permanently remove:</p>
                    <ul>
                        <li>Your profile and personal information</li>
                        <li>All your data and preferences</li>
                        <li>Order history and saved items</li>
                        <li>All associated content</li>
                    </ul>
                    <div class="mb-3">
                        <label for="delete_confirmation" class="form-label">
                            Type <strong>DELETE</strong> to confirm:
                        </label>
                        <input type="text" class="form-control" id="delete_confirmation"
                               placeholder="Type DELETE here">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete" disabled>
                        <i class="fas fa-trash me-2"></i>Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Tab persistence
        document.addEventListener('DOMContentLoaded', function() {
            var activeTab = localStorage.getItem('profileActiveTab');
            if (activeTab) {
                var tabElement = document.querySelector('[href="' + activeTab + '"]');
                if (tabElement) {
                    var tab = new bootstrap.Tab(tabElement);
                    tab.show();
                }
            }

            // Save active tab
            document.querySelectorAll('[data-bs-toggle="tab"]').forEach(function(tabEl) {
                tabEl.addEventListener('shown.bs.tab', function(event) {
                    localStorage.setItem('profileActiveTab', event.target.getAttribute('href'));
                });
            });

            // Delete confirmation
            var deleteInput = document.getElementById('delete_confirmation');
            var deleteButton = document.getElementById('confirmDelete');

            deleteInput.addEventListener('input', function() {
                if (this.value === 'DELETE') {
                    deleteButton.disabled = false;
                } else {
                    deleteButton.disabled = true;
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
