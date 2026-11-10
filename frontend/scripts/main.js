const galleries = [...document.querySelectorAll('[data-page="project"] .gallery')]
const galleryItems = new Map(galleries.map((gallery) => [gallery, [...gallery.querySelectorAll('.gallery-item')]]))

function getColumnCount() {
    if (window.matchMedia('(max-width: 640px)').matches) return 1
    if (window.matchMedia('(max-width: 768px)').matches) return 2
    return 4
}

function layoutGallery(gallery, items) {
    const columnCount = getColumnCount()
    if (!items.length) return

    const columns = Array.from({ length: columnCount }, () => {
        const column = document.createElement('div')
        column.className = 'gallery-column'
        gallery.append(column)
        return column
    })

    // Start one image in each column so the first row shares the same top edge.
    items.slice(0, columnCount).forEach((item, index) => columns[index].append(item))

    // Put each remaining image in the currently shortest column.
    items.slice(columnCount).forEach((item) => {
        const shortestColumn = columns.reduce((shortest, column) =>
            column.getBoundingClientRect().height < shortest.getBoundingClientRect().height ? column : shortest
        )
        shortestColumn.append(item)
    })
}

function arrangeGalleries() {
    galleries.forEach((gallery) => {
        const items = galleryItems.get(gallery)
        gallery.replaceChildren()
        gallery.classList.add('is-masonry')
        layoutGallery(gallery, items)
    })
}

arrangeGalleries()

let resizeTimer
window.addEventListener('resize', () => {
    window.clearTimeout(resizeTimer)
    resizeTimer = window.setTimeout(arrangeGalleries, 120)
})

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
