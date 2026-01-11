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
            <h3 class="text-center mb-4">Ajoutez votre photo</h3>
            <form action="{{ route('galerie.store') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                @csrf
                <div class="upload-options mb-4 text-center">
                    <button type="button" class="btn btn-outline-light mx-2" id="camera-btn">
                        <i class="fas fa-camera me-2"></i>Prendre une photo
                    </button>
                    <button type="button" class="btn btn-outline-light mx-2" id="browse-btn">
                        <i class="fas fa-image me-2"></i>Choisir une photo
                    </button>
                </div>
                
                <div class="upload-area" id="upload-area">
                    <div class="upload-content">
                        <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                        <p>Glissez-déposez votre photo ici</p>
                        <input type="file" id="image-input" name="image" accept="image/*" style="display: none;" required>
                        <input type="file" id="camera-input" name="image" accept="image/*" capture="camera" style="display: none;" required>
                        <video id="camera-preview" style="display: none; width: 100%; max-height: 300px;"></video>
                        <canvas id="camera-canvas" style="display: none;"></canvas>
                    </div>
                    <div class="preview-container" id="preview-container" style="display: none;">
                        <img id="image-preview" src="" alt="Preview">
                        <div class="preview-actions">
                            <button type="button" class="btn btn-danger btn-sm" id="remove-preview">
                                <i class="fas fa-times"></i>
                            </button>
                            <button type="button" class="btn btn-outline-light btn-sm" id="retake-photo" style="display: none;">
                                <i class="fas fa-redo"></i> Reprendre
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
            @forelse($images as $galleryImage)
            <div class="gallery-item" data-id="{{ $galleryImage->id }}">
                <div class="gallery-img-container">
                    <img src="{{ Storage::url($galleryImage->image_path) }}" alt="Festival moment" class="gallery-img">
                    <div class="gallery-overlay">
                        <div class="gallery-info">
                            <h5>{{ $galleryImage->author_name ?? 'Anonyme' }}</h5>
                            <p class="caption">{{ $galleryImage->caption ?? '' }}</p>
                            <p>{{ $galleryImage->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="gallery-actions">
                            <button class="btn btn-sm btn-outline-light share-btn" 
                                    data-image="{{ Storage::url($galleryImage->image_path) }}" 
                                    data-caption="{{ $galleryImage->caption ?? 'Découvrez ce moment incroyable du festival!' }}"
                                    data-id="{{ $galleryImage->id }}">
                                <i class="fas fa-share-alt"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-light download-btn" 
                                    data-image="{{ Storage::url($galleryImage->image_path) }}"
                                    data-filename="jade-birthday-{{ $galleryImage->id }}.jpg">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-gallery text-center py-5">
                <i class="fas fa-images fa-4x mb-3"></i>
                <h4>Aucune photo pour le moment</h4>
                <p>Soyez le premier à partager un moment du festival!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal pour afficher l'image en grand -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="modal-title"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modal-image" src="" alt="Festival moment" class="w-100%">
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
                    <button class="btn btn-outline-light btn-sm download-image" id="modal-download-image">
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
                <div class="preview-image-container mb-3">
                    <img id="share-preview-image" src="" alt="Preview" class="img-fluid rounded">
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
        const cameraBtn = document.getElementById('camera-btn');
        const imageInput = document.getElementById('image-input');
        const cameraInput = document.getElementById('camera-input');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const cameraPreview = document.getElementById('camera-preview');
        const cameraCanvas = document.getElementById('camera-canvas');
        const removePreview = document.getElementById('remove-preview');
        const retakePhoto = document.getElementById('retake-photo');
        const submitBtn = document.getElementById('submit-btn');
        const uploadForm = document.getElementById('upload-form');
        let stream = null;
        let currentImageType = null; // 'file' ou 'camera'
        let currentImageData = null; // Pour stocker les données de l'image
        
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
            currentImageType = 'file';
            imageInput.click();
        });
        
        cameraBtn.addEventListener('click', function() {
            currentImageType = 'camera';
            cameraInput.click();
        });
        
        // Gestion de l'input de la caméra
        cameraInput.addEventListener('change', function() {
            if (this.files.length) {
                startCamera();
            }
        });
        
        // Fonction pour démarrer la caméra
        async function startCamera() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: 'environment',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    } 
                });
                
                cameraPreview.srcObject = stream;
                cameraPreview.style.display = 'block';
                uploadArea.querySelector('.upload-content').style.display = 'none';
                
                // Ajouter le bouton pour prendre la photo
                const takePhotoBtn = document.createElement('button');
                takePhotoBtn.className = 'btn btn-danger mt-3';
                takePhotoBtn.innerHTML = '<i class="fas fa-camera me-2"></i>Prendre la photo';
                takePhotoBtn.addEventListener('click', takePhoto);
                
                // Ajouter le bouton pour basculer entre les caméras
                const switchCameraBtn = document.createElement('button');
                switchCameraBtn.className = 'btn btn-outline-light mt-2';
                switchCameraBtn.innerHTML = '<i class="fas fa-sync-alt me-2"></i>Changer de caméra';
                switchCameraBtn.addEventListener('click', switchCamera);
                
                // Vider le conteneur et ajouter les nouveaux boutons
                const controlsContainer = document.createElement('div');
                controlsContainer.className = 'camera-controls text-center';
                controlsContainer.appendChild(takePhotoBtn);
                controlsContainer.appendChild(switchCameraBtn);
                
                // Remplacer le contenu de l'upload-area
                uploadArea.innerHTML = '';
                uploadArea.appendChild(cameraPreview);
                uploadArea.appendChild(controlsContainer);
                
                submitBtn.disabled = false;
            } catch (err) {
                console.error("Erreur d'accès à la caméra:", err);
                showNotification("Impossible d'accéder à la caméra. Veuillez vérifier les permissions.", "error");
            }
        }
        
        // Fonction pour prendre une photo
        function takePhoto() {
            const context = cameraCanvas.getContext('2d');
            cameraCanvas.width = cameraPreview.videoWidth;
            cameraCanvas.height = cameraPreview.videoHeight;
            context.drawImage(cameraPreview, 0, 0, cameraCanvas.width, cameraCanvas.height);
            
            // Arrêter la caméra
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            
            // Stocker les données de l'image
            currentImageData = cameraCanvas.toDataURL('image/jpeg');
            
            // Afficher la photo
            imagePreview.src = currentImageData;
            previewContainer.style.display = 'block';
            retakePhoto.style.display = 'inline-block';
            
            // Mettre à jour le formulaire pour l'envoi
            uploadArea.innerHTML = '';
            uploadArea.appendChild(previewContainer);
            
            // Créer un input caché pour l'image
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'image';
            hiddenInput.id = 'captured-image';
            
            // Convertir le canvas en blob et créer un fichier
            cameraCanvas.toBlob(function(blob) {
                const file = new File([blob], "photo.jpg", { type: "image/jpeg" });
                
                // Créer un DataTransfer pour simuler la sélection de fichier
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                hiddenInput.files = dataTransfer.files;
                
                uploadForm.appendChild(hiddenInput);
            });
        }
        
        // Fonction pour basculer entre les caméras
        async function switchCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            
            // Inverser la direction de la caméra
            const currentFacingMode = cameraPreview.srcObject.getVideoTracks()[0].getSettings().facingMode;
            const newFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
            
            try {
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { facingMode: newFacingMode }
                });
                
                cameraPreview.srcObject = stream;
            } catch (err) {
                console.error("Erreur lors du changement de caméra:", err);
                showNotification("Impossible de changer de caméra.", "error");
            }
        }
        
        // Gestion de l'input de fichier
        imageInput.addEventListener('change', function() {
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
                // Vérifier la taille du fichier (limite à 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    showNotification('L\'image est trop grande. Veuillez choisir une image de moins de 5MB.', "error");
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    currentImageData = e.target.result;
                    imagePreview.src = currentImageData;
                    previewContainer.style.display = 'block';
                    uploadArea.querySelector('.upload-content').style.display = 'none';
                    submitBtn.disabled = false;
                };
                
                reader.readAsDataURL(file);
            } else {
                showNotification('Veuillez sélectionner un fichier image valide.', "error");
            }
        }
        
        // Bouton pour supprimer la preview
        removePreview.addEventListener('click', function() {
            resetUploadForm();
        });
        
        // Bouton pour reprendre une photo
        retakePhoto.addEventListener('click', function() {
            resetUploadForm();
            startCamera();
        });
        
        // Fonction pour réinitialiser le formulaire d'upload
        function resetUploadForm() {
            imageInput.value = '';
            cameraInput.value = '';
            previewContainer.style.display = 'none';
            cameraPreview.style.display = 'none';
            retakePhoto.style.display = 'none';
            currentImageData = null;
            
            // Recréer le contenu original de l'upload-area
            uploadArea.innerHTML = `
                <div class="upload-content">
                    <i class="fas fa-cloud-upload-alt fa-3x mb-3"></i>
                    <p>Glissez-déposez votre photo ici</p>
                </div>
            `;
            
            // Réattacher les écouteurs d'événements
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
            
            submitBtn.disabled = true;
            
            // Arrêter la caméra si elle est active
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        }
        
        // Soumission du formulaire
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Afficher un indicateur de chargement
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi en cours...';
            
            // Créer un FormData pour l'envoi
            const formData = new FormData(uploadForm);
            
            // Si nous avons des données d'image (pour la caméra)
            if (currentImageData && currentImageType === 'camera') {
                // Convertir les données de l'image en blob
                fetch(currentImageData)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], "photo.jpg", { type: "image/jpeg" });
                        formData.set('image', file);
                        
                        // Envoyer le formulaire
                        sendFormData(formData);
                    });
            } else {
                // Envoyer le formulaire directement
                sendFormData(formData);
            }
        });
        
        // Fonction pour envoyer les données du formulaire
        function sendFormData(formData) {
            fetch(uploadForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de l\'envoi de l\'image');
                }
                return response.text();
            })
            .then(html => {
                // Afficher un message de succès
                showNotification('Votre photo a été partagée avec succès!');
                
                // Réinitialiser le formulaire
                resetUploadForm();
                
                // Recharger la page après un court délai pour voir la nouvelle image
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification('Une erreur est survenue lors du téléchargement de votre photo.', "error");
                
                // Réinitialiser le bouton
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-upload me-2"></i>Partager';
            });
        }
        
        // Gallery modal
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        const modalImage = document.getElementById('modal-image');
        const modalTitle = document.getElementById('modal-title');
        const modalCaption = document.getElementById('modal-caption');
        const galleryImgs = document.querySelectorAll('.gallery-img');
        
        galleryImgs.forEach(img => {
            img.addEventListener('click', function() {
                modalImage.src = this.src;
                modalTitle.textContent = this.alt || 'Moment du festival';
                modalCaption.textContent = this.parentElement.querySelector('.caption')?.textContent || '';
                
                // Mettre à jour les boutons de partage
                document.getElementById('modal-share-instagram').setAttribute('data-image', this.src);
                document.getElementById('modal-share-facebook').setAttribute('data-image', this.src);
                document.getElementById('modal-share-twitter').setAttribute('data-image', this.src);
                document.getElementById('modal-share-snapchat').setAttribute('data-image', this.src);
                document.getElementById('modal-download-image').setAttribute('data-image', this.src);
                
                modal.show();
            });
        });
        
        // Share buttons
        const shareBtns = document.querySelectorAll('.share-btn');
        const shareModal = new bootstrap.Modal(document.getElementById('shareModal'));
        const customCaption = document.getElementById('custom-caption');
        const sharePreviewImage = document.getElementById('share-preview-image');
        
        shareBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const imageUrl = this.getAttribute('data-image');
                const defaultCaption = this.getAttribute('data-caption');
                
                // Afficher l'aperçu de l'image
                sharePreviewImage.src = imageUrl;
                
                // Pré-remplir le champ de légende
                customCaption.value = defaultCaption;
                
                // Stocker l'URL de l'image pour les boutons de partage
                document.getElementById('share-instagram').setAttribute('data-image', imageUrl);
                document.getElementById('share-facebook').setAttribute('data-image', imageUrl);
                document.getElementById('share-twitter').setAttribute('data-image', imageUrl);
                document.getElementById('share-snapchat').setAttribute('data-image', imageUrl);
                document.getElementById('share-whatsapp').setAttribute('data-image', imageUrl);
                
                shareModal.show();
            });
        });
        
        // Boutons de partage dans le modal
        document.getElementById('share-instagram').addEventListener('click', function() {
            shareToSocial('instagram', this.getAttribute('data-image'), customCaption.value);
        });
        
        document.getElementById('share-facebook').addEventListener('click', function() {
            shareToSocial('facebook', this.getAttribute('data-image'), customCaption.value);
        });
        
        document.getElementById('share-twitter').addEventListener('click', function() {
            shareToSocial('twitter', this.getAttribute('data-image'), customCaption.value);
        });
        
        document.getElementById('share-snapchat').addEventListener('click', function() {
            shareToSocial('snapchat', this.getAttribute('data-image'), customCaption.value);
        });
        
        document.getElementById('share-whatsapp').addEventListener('click', function() {
            shareToSocial('whatsapp', this.getAttribute('data-image'), customCaption.value);
        });
        
        // Boutons de partage dans le modal de l'image
        document.getElementById('modal-share-instagram').addEventListener('click', function() {
            const imageUrl = document.getElementById('modal-image').src;
            const caption = document.getElementById('modal-caption').textContent;
            shareToSocial('instagram', imageUrl, caption);
        });
        
        document.getElementById('modal-share-facebook').addEventListener('click', function() {
            const imageUrl = document.getElementById('modal-image').src;
            const caption = document.getElementById('modal-caption').textContent;
            shareToSocial('facebook', imageUrl, caption);
        });
        
        document.getElementById('modal-share-twitter').addEventListener('click', function() {
            const imageUrl = document.getElementById('modal-image').src;
            const caption = document.getElementById('modal-caption').textContent;
            shareToSocial('twitter', imageUrl, caption);
        });
        
        document.getElementById('modal-share-snapchat').addEventListener('click', function() {
            const imageUrl = document.getElementById('modal-image').src;
            const caption = document.getElementById('modal-caption').textContent;
            shareToSocial('snapchat', imageUrl, caption);
        });
        
        document.getElementById('modal-download-image').addEventListener('click', function() {
            const imageUrl = document.getElementById('modal-image').src;
            downloadImage(imageUrl, 'jade-birthday.jpg');
        });
        
        // Boutons de téléchargement
        document.querySelectorAll('.download-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const imageUrl = this.getAttribute('data-image');
                const filename = this.getAttribute('data-filename');
                downloadImage(imageUrl, filename);
            });
        });
        
        // Fonction pour partager sur les réseaux sociaux
        function shareToSocial(platform, imageUrl, caption) {
            const encodedUrl = encodeURIComponent(window.location.href);
            const encodedCaption = encodeURIComponent(caption + ' #JadeBirthday23 #BelliniFest');
            
            let shareUrl = '';
            
            switch(platform) {
                case 'instagram':
                    // Pour Instagram, nous allons télécharger l'image et afficher des instructions
                    downloadImage(imageUrl, 'jade-birthday-instagram.jpg');
                    showNotification('Image téléchargée! Vous pouvez maintenant la partager sur Instagram.', 'success');
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
                    // Pour Snapchat, nous allons télécharger l'image et afficher des instructions
                    downloadImage(imageUrl, 'jade-birthday-snapchat.jpg');
                    showNotification('Image téléchargée! Vous pouvez maintenant la partager sur Snapchat.', 'success');
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
            
            // Fermer le modal de l'image s'il est ouvert
            const imageModalElement = document.getElementById('imageModal');
            if (imageModalElement.classList.contains('show')) {
                const modalInstance = bootstrap.Modal.getInstance(imageModalElement);
                modalInstance.hide();
            }
        }
        
        // Fonction pour télécharger une image
        function downloadImage(imageUrl, filename) {
            fetch(imageUrl)
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
                    console.error('Erreur lors du téléchargement de l\'image:', error);
                    showNotification('Erreur lors du téléchargement de l\'image.', 'error');
                });
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

.camera-controls {
    margin-top: 15px;
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

.gallery-img-container {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-item:hover .gallery-img {
    transform: scale(1.05);
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

.preview-image-container {
    text-align: center;
    margin-bottom: 15px;
}

.preview-image-container img {
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