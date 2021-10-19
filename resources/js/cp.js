if (window.location.pathname.includes('/collections')) {
    Array.from(document.querySelectorAll('.nav-main-inner ul:nth-child(2) li a')).filter((el) => {
        return el.href.includes('/cp/collections/products')
            || el.href.includes('/cp/collections/coupons')
            || el.href.includes('/cp/collections/orders')
            || el.href.includes('/cp/collections/customers')
    }).forEach((el) => {
        el.parentElement.outerHTML = ''
    })
}