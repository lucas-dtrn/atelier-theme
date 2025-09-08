import $ from 'jquery'

// Disable scroll
export function disableScroll() {
    let scrollTop
    let scrollLeft

    // Get the current page scroll position
    scrollTop = window.scrollY || document.documentElement.scrollTop
    scrollLeft = window.scrollX || document.documentElement.scrollLeft

    // if any scroll is attempted, set this to the previous value
    window.onscroll = function () {
        window.scrollTo(scrollLeft, scrollTop)
    }
}

// Enable scroll
export function enableScroll() {
    window.onscroll = function () {}
    $('body').removeClass('--hide-scrollbar')
}
