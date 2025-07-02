<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'CRTS') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <script src="{{ asset('js/main.js') }}"></script>


  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8f9fa;
    }

    .hero-section {
      background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
      color: white;
      padding: 4rem 0;
    }

    .feature-card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
    }

    .btn-primary {
      background-color: #0d6efd;
      border-color: #0d6efd;
      padding: 0.5rem 1.5rem;
    }

    .btn-primary:hover {
      background-color: #0b5ed7;
      border-color: #0a58ca;
    }

    .btn-outline-light {
      border-width: 2px;
    }

    body {
      padding-top: 100px;
    }

    .hero-section {
      min-height: 60vh;
      position: relative;
      overflow: hidden;
    }

    .hero-bg {
      background-size: cover !important;
      background-position: center !important;
      background-repeat: no-repeat !important;
      min-height: 60vh;
    }

    .hero-overlay {
      background: rgba(0, 0, 0, 0.45);
    }

    @media (max-width: 768px) {
      .hero-section {
        min-height: 40vh;
        padding-top: 2rem;
        padding-bottom: 2rem;
      }

      .hero-bg {
        min-height: 40vh;
      }
    }
  </style>
</head>

<body>
  <!-- Navigation -->
  @include('layouts.navbar')


  <!-- Hero Section -->
  <section class="hero-section position-relative d-flex align-items-center justify-content-center" style="min-height: 60vh;">
    <div class="hero-bg position-absolute top-0 start-0 w-100 h-100" style="background: url('{{ asset('images/banner.jpeg') }}') center center / cover no-repeat; z-index: 1;"></div>
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.45); z-index: 2;"></div>
    <div class="container text-center position-relative" style="z-index: 3;">
      <h1 class="display-4 mb-4 text-white fw-bold">Welcome to CRTS</h1>
      <p class="lead mb-4 text-white">Generate your ticket and track their progress easily</p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('complaints.create') }}" class="btn btn-light btn-lg">Create Ticket</a>
        @auth
        <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-lg">Dashboard</a>
        @endauth
        @guest
        <button type="button" class="btn btn-outline-light btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">
          Login
        </button>
        @endguest
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card feature-card h-100">
            <div class="card-body text-center p-4">
              <h3 class="h5 mb-3">Easy Submission</h3>
              <p class="text-muted mb-0">Submit your tickets quickly and easily without any login required.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card feature-card h-100" style="cursor:pointer;"

            id="trackProgressBtn"
            data-dashboard-url="{{ route('dashboard') }}"
            data-history-url="{{ route('complaints.history') }}">
            <div class="card-body text-center p-4">
              <h3 class="h5 mb-3">Track Progress</h3>
              <p class="text-muted mb-0">Monitor the status of your tickets in real-time.</p>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card feature-card h-100">
            <div class="card-body text-center p-4">
              <h3 class="h5 mb-3">Quick Resolution</h3>
              <p class="text-muted mb-0">Our team works efficiently to resolve your tickets.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-white py-4 mt-auto">



    <div class="container">
      <div class="row">
        <div class="col-6 d-flex">


          <img src="{{ asset('images/nic.png') }}" alt="NIC">
          <div class="div mt-1">
            <p class="text-muted mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'CRTS') }}. All rights reserved.</p>

          </div>

        </div>

        <div class="col-6 pt-1" style="text-align: right;">
          <p class="text-muted mb-0">Last updated {{ now()->format('d/m/Y - H:i:s') }}</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
              @error('username')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
              @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Search Ticket Modal -->
  <div class="modal fade" id="searchTicketModal" tabindex="-1" aria-labelledby="searchTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="searchTicketModalLabel">Search Ticket</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="searchTicketForm" autocomplete="off">
            <div class="mb-3">
              <label for="reference_number" class="form-label">Ticket Reference Number</label>
              <input type="text" class="form-control" id="reference_number" name="reference_number" required>
            </div>
            <div id="searchError" class="alert alert-danger d-none"></div>
            <button type="submit" class="btn btn-primary w-100">Search</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Ticket Details Modal -->
  <div class="modal fade" id="complaintDetailsModal" tabindex="-1" aria-labelledby="complaintDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="complaintDetailsModalLabel">Ticket Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="complaintDetailsBody">
          <!-- Details will be loaded here -->
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script>
    window.ALLOWED_IPS = @json(config('app.allowed_ips', []));
    window.USER_IP = '{{ $user_ip ?? request()->ip() }}';
    // console.log('window.USER_IP:', window.USER_IP);
    // alert('window.USER_IP: ' + window.USER_IP);
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const trackProgressBtn = document.getElementById('trackProgressBtn');
      const searchTicketModalElement = document.getElementById('searchTicketModal');
      const complaintDetailsModalElement = document.getElementById('complaintDetailsModal');
      const complaintDetailsBody = document.getElementById('complaintDetailsBody');
      const searchTicketForm = document.getElementById('searchTicketForm');
      const searchError = document.getElementById('searchError');
      let searchTicketModal, complaintDetailsModal;
      if (searchTicketModalElement) {
        searchTicketModal = new bootstrap.Modal(searchTicketModalElement);

        // Always remove backdrop when searchTicketModal is closed
        searchTicketModalElement.addEventListener('hidden.bs.modal', function() {
          // Remove any remaining modal backdrop
          const backdrop = document.querySelector('.modal-backdrop');
          if (backdrop) {
            backdrop.remove();
          }
          // Only clear input and error, not complaintDetailsBody
          const refInput = document.getElementById('reference_number');
          if (refInput) refInput.value = '';
          if (searchError) searchError.classList.add('d-none');
        });
        // Also clear on modal open
        searchTicketModalElement.addEventListener('show.bs.modal', function() {
          const refInput = document.getElementById('reference_number');
          if (refInput) refInput.value = '';
          if (searchError) searchError.classList.add('d-none');
        });
      }
      if (complaintDetailsModalElement) {
        complaintDetailsModal = new bootstrap.Modal(complaintDetailsModalElement);
      }
      trackProgressBtn.addEventListener('click', function() {
        // alert('Your IP address is: ' + window.USER_IP);
        if (window.ALLOWED_IPS.includes(window.USER_IP)) {
          window.location.href = trackProgressBtn.dataset.historyUrl;
        } else {
          if (searchTicketModal) {
            searchTicketModal.show();
          }
        }
      });
      if (searchTicketForm) {
        searchTicketForm.addEventListener('submit', function(e) {
          e.preventDefault();
          searchError.classList.add('d-none');
          const refInput = document.getElementById('reference_number');
          if (!refInput) {
            searchError.textContent = 'Reference number input not found.';
            searchError.classList.remove('d-none');
            return;
          }
          const ref = refInput.value.trim();
          if (!ref) {
            searchError.textContent = 'Please enter a complaint reference number.';
            searchError.classList.remove('d-none');
            return;
          }
          // Only clear complaintDetailsBody when a new search is performed (before fetch)
          complaintDetailsBody.innerHTML = '';
          fetch(`/api/complaints/lookup?reference_number=${encodeURIComponent(ref)}`)
            .then(async res => {
              let data;
              try {
                data = await res.json();
              } catch {
                data = {};
              }
              if (res.ok && data.success) {
                let html = `
                                    <div class='mb-3'>
                                        <div class="bg-primary text-white rounded-3 px-3 py-2 mb-3 text-center fw-bold fs-5">
                                            Reference: ${data.complaint.reference_number}
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                                            <div><span class="fw-semibold">Status:</span> <span class="badge bg-light text-primary border border-primary">${data.complaint.status}</span></div>
                                            <div><span class="fw-semibold">Priority:</span> <span class="badge bg-warning text-dark">${data.complaint.priority}</span></div>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-md-6">
                                                <div class="border rounded-3 p-3 h-100">
                                                    <div class="fw-semibold text-primary mb-2">User Info</div>
                                                    <div><span class="fw-semibold">Name:</span> ${data.complaint.created_by}</div>
                                                    <div><span class="fw-semibold">Intercom:</span> ${data.complaint.intercom}</div>
                                                    <div><span class="fw-semibold">Created:</span> ${data.complaint.created_at}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="border rounded-3 p-3 h-100">
                                                    <div class="fw-semibold text-primary mb-2">Ticket Info</div>
                                                    <div><span class="fw-semibold">Issue:</span> ${data.complaint.network}</div>
                                                    <div><span class="fw-semibold">Section:</span> ${data.complaint.section}</div>
                                                    <div><span class="fw-semibold">Vertical:</span> ${data.complaint.vertical}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <div class="fw-semibold text-primary mb-1">Description</div>
                                            <div class="border rounded-3 p-3 bg-light">${data.complaint.description}</div>
                                        </div>
                                    </div>
                                `;
                complaintDetailsBody.innerHTML = html;
                // Hide search modal and cleanup
                const searchModal = bootstrap.Modal.getInstance(document.getElementById('searchTicketModal'));
                if (searchModal) {
                  searchModal.hide();
                  // Wait for modal to be hidden
                  searchModal._element.addEventListener('hidden.bs.modal', function() {
                    // Remove backdrop
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                      backdrop.remove();
                    }
                    // Show complaint details modal
                    complaintDetailsModal.show();
                  });
                }
              } else {
                searchError.textContent = (data && data.error) ? data.error : 'Ticket not found.';
                searchError.classList.remove('d-none');
              }
            })
            .catch(() => {
              searchError.textContent = 'Ticket not found.';
              searchError.classList.remove('d-none');
            });
        });
      }
    });
  </script>
  @if($errors->has('username') || $errors->has('password'))
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
      loginModal.show();
    });
  </script>
  @endif
</body>

</html>