@extends('layouts.app')

@section('title', 'Galerie - Jade Birthday 23 - Bellini Fest')

@section('floating-assets')
    <x-floating-asset class="asset-bellini-1" svg="bellini.png"/>
    <x-floating-asset class="asset-coupe-1" svg="coupe.png"/>
    <x-floating-asset class="asset-smirnoff-1" svg="smirnoff.png"/>
    <x-floating-asset class="asset-martini-1" svg="martini.png"/>
    <x-floating-asset class="asset-camera-1" svg="camera.png"/>
    <x-floating-asset class="asset-champagne-1" svg="champagne.png"/>
@endsection

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="festival-title mb-4">LIVE SNAPS</h1>
        <p class="lead">Partagez vos meilleurs moments du festival!</p>
    </div>
    
    <div class="upload-section mb-5">
        <div class="upload-container">
            <h3 class="text-center mb-4">Ajoutez votre photo ou vidéo</h3>
            <form action="{{ route('galerie.store') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                @csrf
                <div class="upload-options mb-4 text-center">
                    <button type="button" class="btn btn-outline-light mx-2" id="photo-btn">
                        <i class="fas fa-camera me-2"></i>Prendre une photo
                    </button>
                    <button type="button" class="btn btn-outline-light mx-2" id="video-btn">
                        <i class="fas fa-video me-2"></i>Enregistrer une vidéo
                    </button>
                    <button type="button" class="btn btn-outline-light mx-2" id="browse-btn">
                        <i class="fas fa-image me-2"></i>Choisir depuis la galerie
                    </button>
                </div>
                
                <div class="upload-area" id="upload-area">
                    <div class="upload-content">
                        <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                        <p>Glissez-déposez votre photo ou vidéo ici</p>
                        <input type="file" id="image-input" name="media" accept="image/*" style="display: none;">
                        <input type="file" id="video-input" name="media" accept="video/*" style="display: none;">
                        <input type="file" id="camera-input" name="media" accept="image/*" capture="camera" style="display: none;">
                        <video id="video-preview" style="display: none; width: 100%; max-height: 300px;" controls></video>
                        <input type="hidden" id="media-type" name="media_type" value="image">
                    </div>
                    <div class="preview-container" id="preview-container" style="display: none;">
                        <img id="image-preview" src="" alt="Preview">
                        <div class="preview-actions">
                            <button type="button" class="btn btn-danger btn-sm" id="remove-preview">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <label for="author_name" class="form-label">Votre nom (optionnel)</label>
                        <input type="text" class="form-control" id="author_name" name="author_name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="caption" class="form-label">Légende (optionnel)</label>
                        <textarea class="form-control" id="caption" name="caption" rows="2"></textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger px-5" id="submit-btn" disabled>
                        <i class="fas fa-upload me-2"></i>Partager
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="gallery-section">
        <h3 class="text-center mb-4">Moments du Festival</h3>
        
        <div class="gallery-grid" id="gallery-grid">
            @forelse($media as $mediaItem)
            <div class="gallery-item" data-id="{{ $mediaItem->id }}">
                <div class="gallery-media-container">
                    @if($mediaItem->is_video)
                    <video class="gallery-video" poster="{{ $mediaItem->thumbnail_url }}" preload="metadata">
                        <source src="{{ $mediaItem->media_url }}" type="video/mp4">
                        Votre navigateur ne supporte pas les vidéos HTML5.
                    </video>
                    <div class="video-play-btn">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    @else
                    <img src="{{ $mediaItem->thumbnail_url }}" alt="Festival moment" class="gallery-img">
                    @endif
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h5>{{ $mediaItem->author_name ?? 'Anonyme' }}</h5>
                            <p class="caption">{{ $mediaItem->caption ?? '' }}</p>
                            <p>{{ $mediaItem->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="gallery-actions">
                            <button class="btn btn-sm btn-outline-light share-btn" 
                                    data-media="{{ $mediaItem->media_url }}" 
                                    data-thumbnail="{{ $mediaItem->thumbnail_url }}"
                                    data-caption="{{ $mediaItem->caption ?? 'Découvrez ce moment incroyable du festival!' }}"
                                    data-id="{{ $mediaItem->id }}"
                                    data-type="{{ $mediaItem->media_type }}">
                                <i class="fas fa-share-alt"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-light download-btn" 
                                    data-media="{{ $mediaItem->media_url }}"
                                    data-filename="jade-birthday-{{ $mediaItem->id }}.{{ $mediaItem->is_video ? 'mp4' : 'jpg' }}"
                                    data-type="{{ $mediaItem->media_type }}">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-gallery text-center py-5">
                <i class="fas fa-images fa-4x mb-3"></i>
                <h4>Aucun média pour le moment</h4>
                <p>Soyez le premier à partager un moment du festival!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal pour afficher l'image/vidéo en grand -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="modal-title"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="modal-media-container">
                    <!-- Le média sera inséré ici dynamiquement -->
                </div>
            </div>
            <div class="modal-footer border-0">
                <p class="text-white" id="modal-caption"></p>
                <div class="share-options d-flex justify-content-center gap-2">
                    <button class="btn btn-outline-light btn-sm share-instagram" id="modal-share-instagram">
                        <i class="fab fa-instagram"></i>
                    </button>
                    <button class="btn btn-outline-light btn-sm share-facebook" id="modal-share-facebook">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button class="btn btn-outline-light btn-sm share-twitter" id="modal-share-twitter">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button class="btn btn-outline-light btn-sm share-snapchat" id="modal-share-snapchat">
                        <i class="fab fa-snapchat-ghost"></i>
                    </button>
                    <button class="btn btn-outline-light btn-sm download-media" id="modal-download-media">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour le partage sur les réseaux sociaux -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white">Partager sur les réseaux sociaux</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="preview-media-container mb-3">
                    <div id="share-preview-media">
                        <!-- Le média sera inséré ici dynamiquement -->
                    </div>
                </div>
                <div class="social-share text-center">
                    <button class="btn btn-outline-light btn-lg m-2 share-instagram" id="share-instagram">
                        <i class="fab fa-instagram me-2"></i> Instagram
                    </button>
                    <button class="btn btn-outline-light btn-lg m-2 share-facebook" id="share-facebook">
                        <i class="fab fa-facebook-f me-2"></i> Facebook
                    </button>
                    <button class="btn btn-outline-light btn-lg m-2 share-twitter" id="share-twitter">
                        <i class="fab fa-twitter me-2"></i> Twitter
                    </button>
                    <button class="btn btn-outline-light btn-lg m-2 share-snapchat" id="share-snapchat">
                        <i class="fab fa-snapchat-ghost"></i> Snapchat
                    </button>
                    <button class="btn btn-outline-light btn-lg m-2 share-whatsapp" id="share-whatsapp">
                        <i class="fab fa-whatsapp me-2"></i> WhatsApp
                    </button>
                </div>
                <div class="mt-3">
                    <label for="custom-caption" class="form-label text-white">Personnalisez votre message:</label>
                    <textarea class="form-control bg-dark text-white border-secondary" id="custom-caption" rows="3">Découvrez ce moment incroyable du festival! #JadeBirthday23 #BelliniFest</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast pour les notifications -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="notification-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-message">
            Message
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables globales
        const uploadArea = document.getElementById('upload-area');
        const browseBtn = document.getElementById('browse-btn');
        const photoBtn = document.getElementById('photo-btn');
        const videoBtn = document.getElementById('video-btn');
        const imageInput = document.getElementById('image-input');
        const videoInput = document.getElementById('video-input');
        const cameraInput = document.getElementById('camera-input');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const videoPreview = document.getElementById('video-preview');
        const removePreview = document.getElementById('remove-preview');
        const submitBtn = document.getElementById('submit-btn');
        const uploadForm = document.getElementById('upload-form');
        const mediaTypeInput = document.getElementById('media-type');
        
        let currentMediaType = null; // 'image' ou 'video'
        let currentMediaFile = null; // Pour stocker le fichier média
        
        // Fonction pour afficher une notification
        function showNotification(message, type = 'success') {
            const toastEl = document.getElementById('notification-toast');
            const toastBody = document.getElementById('toast-message');
            const toastHeader = toastEl.querySelector('.toast-header');
            
            toastBody.textContent = message;
            
            // Adapter le style selon le type
            toastEl.className = 'toast';
            if (type === 'error') {
                toastEl.classList.add('bg-danger', 'text-white');
                toastHeader.classList.add('bg-danger', 'text-white');
            } else {
                toastEl.classList.add('bg-success', 'text-white');
                toastHeader.classList.add('bg-success', 'text-white');
            }
            
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
        
        // Gestion des boutons d'upload
        browseBtn.addEventListener('click', function() {
            currentMediaType = 'file';
            // Ouvrir le dialogue de sélection de fichier
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*,video/*';
            fileInput.addEventListener('change', function() {
                if (this.files.length) {
                    handleFile(this.files[0]);
                }
            });
            fileInput.click();
        });
        
        // Le bouton "Prendre une photo" ouvre l'appareil photo
        photoBtn.addEventListener('click', function() {
            currentMediaType = 'camera';
            mediaTypeInput.value = 'image';
            cameraInput.click();
        });
        
        videoBtn.addEventListener('click', function() {
            currentMediaType = 'video';
            mediaTypeInput.value = 'video';
            videoInput.click();
        });
        
        // Gestion de l'input d'image
        imageInput.addEventListener('change', function() {
            if (this.files.length) {
                handleFile(this.files[0]);
            }
        });
        
        // Gestion de l'input de l'appareil photo
        cameraInput.addEventListener('change', function() {
            if (this.files.length) {
                handleFile(this.files[0]);
            }
        });
        
        // Gestion de l'input de vidéo
        videoInput.addEventListener('change', function() {
            if (this.files.length) {
                handleFile(this.files[0]);
            }
        });
        
        // Gestion du drag and drop
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.classList.add('drag-over');
        });
        
        uploadArea.addEventListener('dragleave', function() {
            uploadArea.classList.remove('drag-over');
        });
        
        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('drag-over');
            
            if (e.dataTransfer.files.length) {
                handleFile(e.dataTransfer.files[0]);
            }
        });
        
        // Fonction pour gérer les fichiers
        function handleFile(file) {
            if (file.type.startsWith('image/')) {
                mediaTypeInput.value = 'image';
                currentMediaType = 'image';
                currentMediaFile = file;
                
                // Vérifier la taille du fichier (limite à 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    showNotification('Le fichier est trop grand. Veuillez choisir un fichier de moins de 10MB.', "error");
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block';
                    uploadArea.querySelector('.upload-content').style.display = 'none';
                    submitBtn.disabled = false;
                };
                
                reader.readAsDataURL(file);
            } else if (file.type.startsWith('video/')) {
                mediaTypeInput.value = 'video';
                currentMediaType = 'video';
                currentMediaFile = file;
                
                // Vérifier la taille du fichier (limite à 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    showNotification('Le fichier est trop grand. Veuillez choisir un fichier de moins de 10MB.', "error");
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    videoPreview.src = e.target.result;
                    videoPreview.style.display = 'block';
                    uploadArea.querySelector('.upload-content').style.display = 'none';
                    submitBtn.disabled = false;
                };
                
                reader.readAsDataURL(file);
            } else {
                showNotification('Veuillez sélectionner un fichier image ou vidéo valide.', "error");
            }
        }
        
        // Bouton pour supprimer la preview
        removePreview.addEventListener('click', function() {
            resetUploadForm();
        });
        
        // Fonction pour réinitialiser le formulaire d'upload
        function resetUploadForm() {
            imageInput.value = '';
            videoInput.value = '';
            cameraInput.value = '';
            previewContainer.style.display = 'none';
            videoPreview.style.display = 'none';
            currentMediaFile = null;
            
            // Recréer le contenu original de l'upload-area
            uploadArea.innerHTML = `
                <div class="upload-content">
                    <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                    <p>Glissez-déposez votre photo ou vidéo ici</p>
                    <input type="file" id="image-input" name="media" accept="image/*" style="display: none;">
                    <input type="file" id="video-input" name="media" accept="video/*" style="display: none;">
                    <input type="file" id="camera-input" name="media" accept="image/*" capture="camera" style="display: none;">
                    <video id="video-preview" style="display: none; width: 100%; max-height: 300px;" controls></video>
                    <input type="hidden" id="media-type" name="media_type" value="image">
                </div>
            `;
            
            // Réattacher les écouteurs d'événements
            attachEventListeners();
            
            submitBtn.disabled = true;
        }
        
        // Fonction pour attacher les écouteurs d'événements
        function attachEventListeners() {
            // Gestion du drag and drop
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('drag-over');
            });
            
            uploadArea.addEventListener('dragleave', function() {
                uploadArea.classList.remove('drag-over');
            });
            
            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('drag-over');
                
                if (e.dataTransfer.files.length) {
                    handleFile(e.dataTransfer.files[0]);
                }
            });
            
            // Récupérer les nouveaux éléments
            const newImageInput = document.getElementById('image-input');
            const newVideoInput = document.getElementById('video-input');
            const newCameraInput = document.getElementById('camera-input');
            const newVideoPreview = document.getElementById('video-preview');
            
            // Gestion de l'input d'image
            newImageInput.addEventListener('change', function() {
                if (this.files.length) {
                    handleFile(this.files[0]);
                }
            });
            
            // Gestion de l'input de l'appareil photo
            newCameraInput.addEventListener('change', function() {
                if (this.files.length) {
                    handleFile(this.files[0]);
                }
            });
            
            // Gestion de l'input de vidéo
            newVideoInput.addEventListener('change', function() {
                if (this.files.length) {
                    handleFile(this.files[0]);
                }
            });
        }
        
        // Soumission du formulaire
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Afficher un indicateur de chargement
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi en cours...';
            
            // Créer un FormData pour l'envoi
            const formData = new FormData(uploadForm);
            
            // Ajouter le fichier
            if (currentMediaFile) {
                formData.set('media', currentMediaFile);
            }
            
            // Envoyer le formulaire
            fetch(uploadForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Afficher un message de succès
                    showNotification(data.message);
                    
                    // Réinitialiser le formulaire
                    resetUploadForm();
                    
                    // Ajouter le nouveau média à la galerie sans recharger la page
                    if (data.media_url) {
                        addMediaToGallery(data);
                    }
                } else {
                    throw new Error(data.message || 'Erreur lors de l\'envoi du média');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification('Une erreur est survenue lors du téléchargement de votre média.', "error");
                
                // Réinitialiser le bouton
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-upload me-2"></i>Partager';
            });
        });
        
        // Fonction pour ajouter un média à la galerie sans recharger la page
        function addMediaToGallery(data) {
            const galleryGrid = document.getElementById('gallery-grid');
            
            // Créer un nouvel élément de galerie
            const newItem = document.createElement('div');
            newItem.className = 'gallery-item';
            newItem.dataset.id = data.id;
            
            // Déterminer le contenu HTML en fonction du type de média
            let mediaContent = '';
            if (data.type === 'video') {
                mediaContent = `
                    <video class="gallery-video" poster="${data.thumbnail_url || ''}" preload="metadata">
                        <source src="${data.media_url}" type="video/mp4">
                        Votre navigateur ne supporte pas les vidéos HTML5.
                    </video>
                    <div class="video-play-btn">
                        <i class="fas fa-play-circle"></i>
                    </div>
                `;
            } else {
                mediaContent = `
                    <img src="${data.thumbnail_url || data.media_url}" alt="Festival moment" class="gallery-img">
                `;
            }
            
            // Définir le HTML complet de l'élément
            newItem.innerHTML = `
                <div class="gallery-media-container">
                    ${mediaContent}
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h5>${document.getElementById('author_name').value || 'Anonyme'}</h5>
                            <p class="caption">${document.getElementById('caption').value || ''}</p>
                            <p>${new Date().toLocaleDateString('fr-FR')} ${new Date().toLocaleTimeString('fr-FR')}</p>
                        </div>
                        <div class="gallery-actions">
                            <button class="btn btn-sm btn-outline-light share-btn" 
                                    data-media="${data.media_url}" 
                                    data-thumbnail="${data.thumbnail_url || data.media_url}"
                                    data-caption="${document.getElementById('caption').value || 'Découvrez ce moment incroyable du festival!'}"
                                    data-id="${data.id}"
                                    data-type="${data.type}">
                                <i class="fas fa-share-alt"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-light download-btn" 
                                    data-media="${data.media_url}"
                                    data-filename="jade-birthday-${data.id}.${data.type === 'video' ? 'mp4' : 'jpg'}"
                                    data-type="${data.type}">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // Ajouter l'élément au début de la galerie
            galleryGrid.insertBefore(newItem, galleryGrid.firstChild);
            
            // Attacher les écouteurs d'événements au nouvel élément
            attachGalleryItemListeners(newItem);
            
            // Afficher une notification de succès
            showNotification('Votre média a été ajouté à la galerie!');
        }
        
        // Fonction pour attacher les écouteurs d'événements aux éléments de la galerie
        function attachGalleryItemListeners(item) {
            const img = item.querySelector('.gallery-img');
            const video = item.querySelector('.gallery-video');
            const playBtn = item.querySelector('.video-play-btn');
            const shareBtn = item.querySelector('.share-btn');
            const downloadBtn = item.querySelector('.download-btn');
            
            if (img) {
                img.addEventListener('click', function() {
                    const mediaUrl = this.src;
                    const thumbnailUrl = this.src;
                    const caption = this.parentElement.querySelector('.caption')?.textContent || '';
                    showMediaInModal(mediaUrl, 'image', 'Moment du festival', caption, thumbnailUrl);
                });
            }
            
            if (video) {
                video.addEventListener('click', function() {
                    const videoSrc = this.querySelector('source').src;
                    const thumbnailUrl = this.getAttribute('poster');
                    const caption = this.parentElement.querySelector('.caption')?.textContent || '';
                    showMediaInModal(videoSrc, 'video', 'Moment du festival', caption, thumbnailUrl);
                });
            }
            
            if (playBtn) {
                playBtn.addEventListener('click', function() {
                    const video = this.parentElement.querySelector('.gallery-video');
                    const videoSrc = video.querySelector('source').src;
                    const thumbnailUrl = video.getAttribute('poster');
                    const caption = this.parentElement.querySelector('.caption')?.textContent || '';
                    showMediaInModal(videoSrc, 'video', 'Moment du festival', caption, thumbnailUrl);
                });
            }
            
            if (shareBtn) {
                shareBtn.addEventListener('click', function() {
                    const mediaUrl = this.getAttribute('data-media');
                    const thumbnailUrl = this.getAttribute('data-thumbnail');
                    const mediaType = this.getAttribute('data-type');
                    const defaultCaption = this.getAttribute('data-caption');
                    
                    openShareModal(mediaUrl, thumbnailUrl, mediaType, defaultCaption);
                });
            }
            
            if (downloadBtn) {
                downloadBtn.addEventListener('click', function() {
                    const mediaUrl = this.getAttribute('data-media');
                    const filename = this.getAttribute('data-filename');
                    const mediaType = this.getAttribute('data-type');
                    downloadMedia(mediaUrl, filename, mediaType);
                });
            }
        }
        
        // Attacher les écouteurs d'événements aux éléments existants de la galerie
        document.querySelectorAll('.gallery-item').forEach(item => {
            attachGalleryItemListeners(item);
        });
        
        // Gallery modal
        const modal = new bootstrap.Modal(document.getElementById('mediaModal'));
        const modalMediaContainer = document.getElementById('modal-media-container');
        const modalTitle = document.getElementById('modal-title');
        const modalCaption = document.getElementById('modal-caption');
        
        // Fonction pour afficher un média dans le modal
        function showMediaInModal(src, type, title, caption, thumbnailUrl = null) {
            modalMediaContainer.innerHTML = '';
            
            if (type === 'video') {
                const video = document.createElement('video');
                video.className = 'w-100';
                video.controls = true;
                video.autoplay = true;
                
                const source = document.createElement('source');
                source.src = src;
                source.type = 'video/mp4';
                
                video.appendChild(source);
                modalMediaContainer.appendChild(video);
            } else {
                const img = document.createElement('img');
                img.src = src;
                img.alt = title || 'Moment du festival';
                img.className = 'w-100';
                modalMediaContainer.appendChild(img);
            }
            
            modalTitle.textContent = title || 'Moment du festival';
            modalCaption.textContent = caption || '';
            
            // Mettre à jour les boutons de partage
            document.getElementById('modal-share-instagram').setAttribute('data-media', src);
            document.getElementById('modal-share-instagram').setAttribute('data-thumbnail', thumbnailUrl || src);
            document.getElementById('modal-share-instagram').setAttribute('data-type', type);
            document.getElementById('modal-share-facebook').setAttribute('data-media', src);
            document.getElementById('modal-share-facebook').setAttribute('data-thumbnail', thumbnailUrl || src);
            document.getElementById('modal-share-facebook').setAttribute('data-type', type);
            document.getElementById('modal-share-twitter').setAttribute('data-media', src);
            document.getElementById('modal-share-twitter').setAttribute('data-thumbnail', thumbnailUrl || src);
            document.getElementById('modal-share-twitter').setAttribute('data-type', type);
            document.getElementById('modal-share-snapchat').setAttribute('data-media', src);
            document.getElementById('modal-share-snapchat').setAttribute('data-thumbnail', thumbnailUrl || src);
            document.getElementById('modal-share-snapchat').setAttribute('data-type', type);
            document.getElementById('modal-download-media').setAttribute('data-media', src);
            document.getElementById('modal-download-media').setAttribute('data-type', type);
            
            modal.show();
        }
        
        // Share buttons
        const shareModal = new bootstrap.Modal(document.getElementById('shareModal'));
        const customCaption = document.getElementById('custom-caption');
        const sharePreviewMedia = document.getElementById('share-preview-media');
        
        // Fonction pour ouvrir le modal de partage
        function openShareModal(mediaUrl, thumbnailUrl, mediaType, defaultCaption) {
            // Afficher l'aperçu du média
            sharePreviewMedia.innerHTML = '';
            
            if (mediaType === 'video') {
                const video = document.createElement('video');
                video.className = 'img-fluid rounded';
                video.controls = true;
                video.poster = thumbnailUrl || '';
                
                const source = document.createElement('source');
                source.src = mediaUrl;
                source.type = 'video/mp4';
                
                video.appendChild(source);
                sharePreviewMedia.appendChild(video);
            } else {
                const img = document.createElement('img');
                img.src = thumbnailUrl || mediaUrl;
                img.alt = 'Preview';
                img.className = 'img-fluid rounded';
                sharePreviewMedia.appendChild(img);
            }
            
            // Pré-remplir le champ de légende
            customCaption.value = defaultCaption;
            
            // Stocker l'URL du média pour les boutons de partage
            document.getElementById('share-instagram').setAttribute('data-media', mediaUrl);
            document.getElementById('share-instagram').setAttribute('data-thumbnail', thumbnailUrl || mediaUrl);
            document.getElementById('share-instagram').setAttribute('data-type', mediaType);
            document.getElementById('share-facebook').setAttribute('data-media', mediaUrl);
            document.getElementById('share-facebook').setAttribute('data-thumbnail', thumbnailUrl || mediaUrl);
            document.getElementById('share-facebook').setAttribute('data-type', mediaType);
            document.getElementById('share-twitter').setAttribute('data-media', mediaUrl);
            document.getElementById('share-twitter').setAttribute('data-thumbnail', thumbnailUrl || mediaUrl);
            document.getElementById('share-twitter').setAttribute('data-type', mediaType);
            document.getElementById('share-snapchat').setAttribute('data-media', mediaUrl);
            document.getElementById('share-snapchat').setAttribute('data-thumbnail', thumbnailUrl || mediaUrl);
            document.getElementById('share-snapchat').setAttribute('data-type', mediaType);
            document.getElementById('share-whatsapp').setAttribute('data-media', mediaUrl);
            document.getElementById('share-whatsapp').setAttribute('data-thumbnail', thumbnailUrl || mediaUrl);
            document.getElementById('share-whatsapp').setAttribute('data-type', mediaType);
            
            shareModal.show();
        }
        
        // Boutons de partage dans le modal
        document.getElementById('share-instagram').addEventListener('click', function() {
            shareToSocial('instagram', this.getAttribute('data-media'), this.getAttribute('data-thumbnail'), this.getAttribute('data-type'), customCaption.value);
        });
        
        document.getElementById('share-facebook').addEventListener('click', function() {
            shareToSocial('facebook', this.getAttribute('data-media'), this.getAttribute('data-thumbnail'), this.getAttribute('data-type'), customCaption.value);
        });
        
        document.getElementById('share-twitter').addEventListener('click', function() {
            shareToSocial('twitter', this.getAttribute('data-media'), this.getAttribute('data-thumbnail'), this.getAttribute('data-type'), customCaption.value);
        });
        
        document.getElementById('share-snapchat').addEventListener('click', function() {
            shareToSocial('snapchat', this.getAttribute('data-media'), this.getAttribute('data-thumbnail'), this.getAttribute('data-type'), customCaption.value);
        });
        
        document.getElementById('share-whatsapp').addEventListener('click', function() {
            shareToSocial('whatsapp', this.getAttribute('data-media'), this.getAttribute('data-thumbnail'), this.getAttribute('data-type'), customCaption.value);
        });
        
        // Boutons de partage dans le modal du média
        document.getElementById('modal-share-instagram').addEventListener('click', function() {
            const mediaUrl = this.getAttribute('data-media');
            const thumbnailUrl = this.getAttribute('data-thumbnail');
            const mediaType = this.getAttribute('data-type');
            const caption = document.getElementById('modal-caption').textContent;
            shareToSocial('instagram', mediaUrl, thumbnailUrl, mediaType, caption);
        });
        
        document.getElementById('modal-share-facebook').addEventListener('click', function() {
            const mediaUrl = this.getAttribute('data-media');
            const thumbnailUrl = this.getAttribute('data-thumbnail');
            const mediaType = this.getAttribute('data-type');
            const caption = document.getElementById('modal-caption').textContent;
            shareToSocial('facebook', mediaUrl, thumbnailUrl, mediaType, caption);
        });
        
        document.getElementById('modal-share-twitter').addEventListener('click', function() {
            const mediaUrl = this.getAttribute('data-media');
            const thumbnailUrl = this.getAttribute('data-thumbnail');
            const mediaType = this.getAttribute('data-type');
            const caption = document.getElementById('modal-caption').textContent;
            shareToSocial('twitter', mediaUrl, thumbnailUrl, mediaType, caption);
        });
        
        document.getElementById('modal-share-snapchat').addEventListener('click', function() {
            const mediaUrl = this.getAttribute('data-media');
            const thumbnailUrl = this.getAttribute('data-thumbnail');
            const mediaType = this.getAttribute('data-type');
            const caption = document.getElementById('modal-caption').textContent;
            shareToSocial('snapchat', mediaUrl, thumbnailUrl, mediaType, caption);
        });
        
        document.getElementById('modal-download-media').addEventListener('click', function() {
            const mediaUrl = this.getAttribute('data-media');
            const mediaType = this.getAttribute('data-type');
            const filename = mediaType === 'video' ? 'jade-birthday-video.mp4' : 'jade-birthday-image.jpg';
            downloadMedia(mediaUrl, filename, mediaType);
        });
        
        // Fonction pour partager sur les réseaux sociaux
        function shareToSocial(platform, mediaUrl, thumbnailUrl, mediaType, caption) {
            const encodedUrl = encodeURIComponent(window.location.href);
            const encodedCaption = encodeURIComponent(caption + ' #JadeBirthday23 #BelliniFest');
            
            let shareUrl = '';
            
            switch(platform) {
                case 'instagram':
                    // Pour Instagram, nous allons télécharger le média et afficher des instructions
                    const filename = mediaType === 'video' ? 'jade-birthday-instagram.mp4' : 'jade-birthday-instagram.jpg';
                    downloadMedia(mediaUrl, filename, mediaType);
                    showNotification('Média téléchargé! Vous pouvez maintenant le partager sur Instagram.', 'success');
                    break;
                    
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}&quote=${encodedCaption}`;
                    window.open(shareUrl, '_blank');
                    break;
                    
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?text=${encodedCaption}&url=${encodedUrl}`;
                    window.open(shareUrl, '_blank');
                    break;
                    
                case 'snapchat':
                    // Pour Snapchat, nous allons télécharger le média et afficher des instructions
                    const snapFilename = mediaType === 'video' ? 'jade-birthday-snapchat.mp4' : 'jade-birthday-snapchat.jpg';
                    downloadMedia(mediaUrl, snapFilename, mediaType);
                    showNotification('Média téléchargé! Vous pouvez maintenant le partager sur Snapchat.', 'success');
                    break;
                    
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${encodedCaption} ${encodedUrl}`;
                    window.open(shareUrl, '_blank');
                    break;
            }
            
            // Fermer le modal de partage s'il est ouvert
            const shareModalElement = document.getElementById('shareModal');
            if (shareModalElement.classList.contains('show')) {
                const modalInstance = bootstrap.Modal.getInstance(shareModalElement);
                modalInstance.hide();
            }
            
            // Fermer le modal du média s'il est ouvert
            const mediaModalElement = document.getElementById('mediaModal');
            if (mediaModalElement.classList.contains('show')) {
                const modalInstance = bootstrap.Modal.getInstance(mediaModalElement);
                modalInstance.hide();
            }
        }
        
        // Fonction pour télécharger un média
        function downloadMedia(mediaUrl, filename, mediaType) {
            if (mediaType === 'video') {
                // Pour les vidéos, créer un lien de téléchargement direct
                const a = document.createElement('a');
                a.href = mediaUrl;
                a.download = filename;
                a.target = '_blank';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            } else {
                // Pour les images, utiliser fetch pour télécharger
                fetch(mediaUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = filename;
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                        document.body.removeChild(a);
                    })
                    .catch(error => {
                        console.error('Erreur lors du téléchargement du média:', error);
                        showNotification('Erreur lors du téléchargement du média.', 'error');
                    });
            }
        }
    });
</script>
@endsection

@push('styles')
<style>
.upload-container {
    background: var(--glass);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 40px;
    padding: 40px;
    box-shadow: var(--shadow);
}

.upload-options {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 20px;
}

.upload-area {
    border: 2px dashed var(--glass-border);
    border-radius: 20px;
    padding: 40px;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.upload-area.drag-over {
    border-color: var(--rose);
    background: rgba(255, 106, 136, 0.1);
}

.upload-content {
    transition: all 0.3s ease;
}

.preview-container {
    position: relative;
    width: 100%;
    text-align: center;
}

.preview-container img {
    max-width: 100%;
    max-height: 400px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.preview-actions {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 10px;
}

.form-control {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid var(--glass-border);
    color: white;
}

.form-control:focus {
    background: rgba(255, 255, 255, 0.2);
    border-color: var(--rose);
    box-shadow: 0 0 0 0 0.25rem rgba(255, 106, 136, 0.25);
    color: white;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: var(--shadow);
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-10px);
}

.gallery-media-container {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.gallery-img, .gallery-video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-item:hover .gallery-img,
.gallery-item:hover .gallery-video {
    transform: scale(1.05);
}

.video-play-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 3rem;
    color: rgba(255, 255, 255, 0.8);
    cursor: pointer;
    transition: all 0.3s ease;
}

.video-play-btn:hover {
    color: white;
    transform: translate(-50%, -50%) scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-info {
    color: white;
}

.gallery-info h5 {
    margin-bottom: 5px;
}

.gallery-info .caption {
    font-size: 0.9rem;
    margin-bottom: 5px;
    font-style: italic;
}

.gallery-info p {
    font-size: 0.8rem;
    opacity: 0.8;
}

.gallery-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.empty-gallery {
    padding: 60px 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    margin-bottom: 30px;
}

.empty-gallery i {
    color: var(--rose);
    margin-bottom: 20px;
}

.btn-close-white {
    filter: invert(1);
}

.social-share {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}

.preview-media-container {
    text-align: center;
    margin-bottom: 15px;
}

.preview-media-container img,
.preview-media-container video {
    max-height: 200px;
    border-radius: 10px;
}

.asset-camera-1 { top: 10%; left: 5%; width: 150px; animation-delay: -1s; }
.asset-champagne-1 { bottom: 15%; right: 5%; width: 180px; animation-delay: -3s; }

/* Styles pour les écrans plus petits */
@media (max-width: 768px) {
    .upload-options {
        flex-direction: column;
        gap: 10px;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
}
</style>
@endpush