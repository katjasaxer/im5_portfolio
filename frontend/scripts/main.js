console.log('hoi js')

const lightbox = document.querySelector('[data-page="project"] .lightbox')

if (lightbox) {
    const lightboxImage = lightbox.querySelector('.lightbox-image')

    document.querySelectorAll('[data-lightbox-src]').forEach((button) => {
        button.addEventListener('click', () => {
            lightboxImage.src = button.dataset.lightboxSrc
            lightboxImage.alt = button.dataset.lightboxAlt || ''
            lightbox.showModal()
        })
    })

    lightbox.querySelector('.lightbox-close').addEventListener('click', () => lightbox.close())
    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) lightbox.close()
    })
}
