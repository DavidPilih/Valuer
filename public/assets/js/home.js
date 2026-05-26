const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
        if (entry.isIntersecting) {
            entry.target.classList.add('vidno');
        }
    });
}, { threshold: 0.2 });
 
document.querySelectorAll('.kontakt-item').forEach(function (el) {
    observer.observe(el);
});