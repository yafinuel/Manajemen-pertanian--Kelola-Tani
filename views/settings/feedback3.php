<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .feedback-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .feedback-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .feedback-form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        
        .rating-stars {
            font-size: 2rem;
            color: #ffc107;
            margin: 20px 0;
        }
        
        .rating-stars i {
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 5px;
        }
        
        .rating-stars i:hover,
        .rating-stars i.active {
            color: #ff8c00;
            transform: scale(1.1);
        }
        
        .feedback-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
            border-left: 4px solid #28a745;
            transition: all 0.3s ease;
        }
        
        .feedback-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        }
        
        .feedback-meta {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, #ff6b6b, #ee5a24);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .feedback-rating {
            color: #ffc107;
            font-size: 1.1rem;
        }
        
        .feedback-date {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .feedback-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-reviewed {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .status-resolved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }
        
        .feedback-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .filter-tabs {
            margin-bottom: 30px;
        }
        
        .filter-tabs .nav-link {
            border-radius: 25px;
            margin-right: 10px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .filter-tabs .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
            color: white;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        @media (max-width: 768px) {
            .feedback-meta {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .rating-stars {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="feedback-container">
        <!-- Header Card -->
        <div class="feedback-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-comments me-3"></i>Feedback & Saran</h2>
                    <p class="mb-0 opacity-75">Berikan masukan Anda untuk membantu kami meningkatkan layanan Kelola Tani</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                        <i class="fas fa-plus me-2"></i>Beri Feedback
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="feedback-stats">
            <div class="stat-card">
                <div class="stat-number">128</div>
                <div class="stat-label">Total Feedback</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">4.8</div>
                <div class="stat-label">Rating Rata-rata</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">95%</div>
                <div class="stat-label">Tingkat Kepuasan</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">24</div>
                <div class="stat-label">Feedback Bulan Ini</div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <ul class="nav nav-pills filter-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-filter="all">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-filter="pending">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-filter="reviewed">Direview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-filter="resolved">Selesai</a>
            </li>
        </ul>

        <!-- Feedback List -->
        <div class="feedback-list">
            <!-- Sample Feedback Items -->
            <div class="feedback-item" data-status="resolved">
                <div class="feedback-meta">
                    <div class="user-avatar">JD</div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">John Doe</h6>
                        <div class="feedback-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            5.0
                        </div>
                    </div>
                    <div class="feedback-date">2 hari yang lalu</div>
                    <span class="feedback-status status-resolved">Selesai</span>
                </div>
                <p class="mb-0">
                    Aplikasi sangat membantu dalam mengelola tanaman saya. Fitur monitoring cuaca dan reminder sangat berguna. 
                    Terima kasih tim Kelola Tani!
                </p>
            </div>

            <div class="feedback-item" data-status="reviewed">
                <div class="feedback-meta">
                    <div class="user-avatar">AS</div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Ani Sari</h6>
                        <div class="feedback-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            4.0
                        </div>
                    </div>
                    <div class="feedback-date">5 hari yang lalu</div>
                    <span class="feedback-status status-reviewed">Direview</span>
                </div>
                <p class="mb-0">
                    Bagus sekali, tapi masih ada beberapa bug kecil di fitur statistik. 
                    Mungkin bisa diperbaiki untuk update selanjutnya.
                </p>
            </div>

            <div class="feedback-item" data-status="pending">
                <div class="feedback-meta">
                    <div class="user-avatar">BW</div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1">Budi Wijaya</h6>
                        <div class="feedback-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            5.0
                        </div>
                    </div>
                    <div class="feedback-date">1 minggu yang lalu</div>
                    <span class="feedback-status status-pending">Pending</span>
                </div>
                <p class="mb-0">
                    Aplikasi yang luar biasa! Saya berharap ada fitur marketplace untuk jual beli hasil tani. 
                    Itu akan sangat membantu petani seperti saya.
                </p>
            </div>
        </div>
    </div>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Berikan Feedback Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="feedbackForm">
                        <div class="mb-4">
                            <label class="form-label">Rating Kepuasan</label>
                            <div class="rating-stars">
                                <i class="far fa-star" data-rating="1"></i>
                                <i class="far fa-star" data-rating="2"></i>
                                <i class="far fa-star" data-rating="3"></i>
                                <i class="far fa-star" data-rating="4"></i>
                                <i class="far fa-star" data-rating="5"></i>
                            </div>
                            <small class="text-muted">Klik bintang untuk memberikan rating</small>
                            <input type="hidden" id="rating" name="rating" value="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori Feedback</label>
                            <select class="form-select" name="category" required>
                                <option value="">Pilih kategori...</option>
                                <option value="bug">Laporan Bug</option>
                                <option value="feature">Saran Fitur</option>
                                <option value="ui">Antarmuka</option>
                                <option value="performance">Performa</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Feedback</label>
                            <input type="text" class="form-control" name="title" placeholder="Ringkas feedback Anda..." required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Detail Feedback</label>
                            <textarea class="form-control" name="message" rows="5" placeholder="Ceritakan pengalaman atau saran Anda secara detail..." required></textarea>
                            <small class="text-muted">Minimal 20 karakter</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-submit">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Rating stars functionality
            $('.rating-stars i').click(function() {
                const rating = $(this).data('rating');
                $('#rating').val(rating);
                
                $('.rating-stars i').removeClass('fas active').addClass('far');
                
                for(let i = 1; i <= rating; i++) {
                    $(`.rating-stars i[data-rating="${i}"]`).removeClass('far').addClass('fas active');
                }
            });

            // Filter functionality
            $('.filter-tabs .nav-link').click(function(e) {
                e.preventDefault();
                
                $('.filter-tabs .nav-link').removeClass('active');
                $(this).addClass('active');
                
                const filter = $(this).data('filter');
                
                if(filter === 'all') {
                    $('.feedback-item').show();
                } else {
                    $('.feedback-item').hide();
                    $(`.feedback-item[data-status="${filter}"]`).show();
                }
            });

            // Form submission
            $('#feedbackForm').submit(function(e) {
                e.preventDefault();
                
                const rating = $('#rating').val();
                if(rating == 0) {
                    alert('Silakan berikan rating terlebih dahulu');
                    return;
                }
                
                // Simulate form submission
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...');
                submitBtn.prop('disabled', true);
                
                setTimeout(function() {
                    $('#feedbackModal').modal('hide');
                    
                    // Show success notification
                    $('body').append(`
                        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="z-index: 9999;">
                            <i class="fas fa-check-circle me-2"></i>Feedback berhasil dikirim! Terima kasih atas masukan Anda.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `);
                    
                    // Reset form
                    $('#feedbackForm')[0].reset();
                    $('#rating').val('0');
                    $('.rating-stars i').removeClass('fas active').addClass('far');
                    
                    submitBtn.html(originalText);
                    submitBtn.prop('disabled', false);
                    
                    // Auto remove notification
                    setTimeout(function() {
                        $('.alert').fadeOut();
                    }, 5000);
                }, 2000);
            });
        });
    </script>
</body>
</html>