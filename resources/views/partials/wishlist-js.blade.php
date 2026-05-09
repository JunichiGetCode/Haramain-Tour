<!-- Wishlist Shared Logic -->
<script>
    /**
     * Toggles a package in/out of the user's wishlist via AJAX.
     * @param {Event} e The click event.
     * @param {HTMLElement} icon The icon element.
     */
    function toggleWishlist(e, icon) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }

        if (!icon) return;
        const packageId = icon.getAttribute('data-package-id');
        if (!packageId) {
            console.error('Wishlist Error: No package ID found on icon.');
            return;
        }

        // Add a temporary loading state or scale effect
        icon.style.transform = 'scale(1.3)';
        icon.style.opacity = '0.7';

        fetch('{{ route("wishlist.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ package_id: packageId })
        })
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(data => {
            if (data.success) {
                // Update all icons with this package ID across the page (Grid, Modal, Search)
                document.querySelectorAll(`.wishlist-toggle[data-package-id="${packageId}"]`).forEach(ic => {
                    if (data.action === 'added') {
                        ic.classList.remove('fa-regular');
                        ic.classList.add('fa-solid');
                        ic.style.color = 'var(--gold-color)';
                    } else {
                        ic.classList.remove('fa-solid');
                        ic.classList.add('fa-regular');
                        ic.style.color = ''; 
                    }
                    ic.style.transform = '';
                    ic.style.opacity = '';
                });
                
                showToast(data.action === 'added' ? 'Paket disimpan ke wishlist!' : 'Paket dihapus dari wishlist.');
            } else {
                showToast('Gagal memproses wishlist.');
            }
        })
        .catch(err => {
            console.error('Wishlist AJAX Error:', err);
            showToast('Terjadi kesalahan jaringan.');
            icon.style.transform = '';
            icon.style.opacity = '';
        });
    }

    // Generic showToast for compatibility
    function showToast(message) {
        const existing = document.getElementById('global-toast');
        if (existing) existing.remove();

        let toast = document.createElement('div');
        toast.id = 'global-toast';
        toast.textContent = message;
        toast.style.cssText = 'position:fixed;bottom:30px;left:50%;transform:translateX(-50%);background:var(--navy-color);color:var(--gold-color);padding:14px 28px;border-radius:14px;font-size:0.9rem;font-weight:600;z-index:99999;box-shadow:0 8px 30px rgba(0,0,0,0.3);border:1px solid rgba(201,168,76,0.3);animation:toastFadeUp 0.3s ease;';
        
        if (!document.getElementById('toast-style')) {
            let style = document.createElement('style');
            style.id = 'toast-style';
            style.innerHTML = '@keyframes toastFadeUp { from { opacity: 0; transform: translate(-50%, 20px); } to { opacity: 1; transform: translate(-50%, 0); } }';
            document.head.appendChild(style);
        }

        document.body.appendChild(toast);
        setTimeout(() => { 
            toast.style.opacity = '0'; 
            toast.style.transition = 'opacity 0.3s ease'; 
            setTimeout(() => toast.remove(), 300);
        }, 2500);
    }
</script>
