const galleries = [...document.querySelectorAll('[data-page="project"] .gallery')]
const galleryItems = new Map(galleries.map((gallery) => [gallery, [...gallery.querySelectorAll('.gallery-item')]]))
const menuToggle = document.querySelector('.nav-toggle')
const mainNavigation = document.querySelector('#main-navigation')

function getColumnCount() {
    if (window.matchMedia('(max-width: 1024px)').matches) return 2
    return 4
}

if (menuToggle && mainNavigation) {
    const closeMenu = () => {
        menuToggle.setAttribute('aria-expanded', 'false')
        menuToggle.setAttribute('aria-label', 'Menü öffnen')
        mainNavigation.classList.remove('is-open')
    }

    menuToggle.addEventListener('click', () => {
        const isOpen = menuToggle.getAttribute('aria-expanded') === 'true'
        menuToggle.setAttribute('aria-expanded', String(!isOpen))
        menuToggle.setAttribute('aria-label', isOpen ? 'Menü öffnen' : 'Menü schließen')
        mainNavigation.classList.toggle('is-open', !isOpen)
    })

    mainNavigation.addEventListener('click', (event) => {
        if (event.target.closest('a')) closeMenu()
    })

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeMenu()
    })

    window.addEventListener('resize', () => {
        if (!window.matchMedia('(max-width: 640px)').matches) closeMenu()
    })
}

document.querySelectorAll('[data-page="project"] .gallery-category-nav').forEach((nav) => {
    const scroller = nav.querySelector('.gallery-category-links')
    const thumb = nav.querySelector('.gallery-category-scrollbar > span')
    let interactionTimer

    const updateScrollbar = () => {
        const scrollableWidth = scroller.scrollWidth
        const visibleWidth = scroller.clientWidth
        const thumbWidth = scrollableWidth ? Math.min(100, visibleWidth / scrollableWidth * 100) : 100
        thumb.style.width = `${thumbWidth}%`
        thumb.style.transform = `translateX(${visibleWidth ? scroller.scrollLeft / visibleWidth * 100 : 0}%)`
        nav.classList.toggle('is-scrollable', scrollableWidth > visibleWidth + 1)
    }

    const showScrollbar = () => {
        nav.classList.add('is-interacting')
        window.clearTimeout(interactionTimer)
        interactionTimer = window.setTimeout(() => nav.classList.remove('is-interacting'), 900)
    }

    nav.querySelector('.gallery-category-arrow--left').addEventListener('click', () => {
        scroller.scrollBy({ left: -180, behavior: 'smooth' })
        showScrollbar()
    })
    nav.querySelector('.gallery-category-arrow--right').addEventListener('click', () => {
        scroller.scrollBy({ left: 180, behavior: 'smooth' })
        showScrollbar()
    })
    scroller.addEventListener('scroll', () => {
        updateScrollbar()
        showScrollbar()
    }, { passive: true })
    scroller.addEventListener('pointerdown', showScrollbar, { passive: true })
    scroller.addEventListener('touchstart', showScrollbar, { passive: true })
    scroller.addEventListener('wheel', showScrollbar, { passive: true })
    window.addEventListener('resize', updateScrollbar)
    updateScrollbar()
})

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
