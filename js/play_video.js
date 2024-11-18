document.addEventListener("DOMContentLoaded", () => {
    const video = document.getElementById("latestVideo");

    // Tạo Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                video.play(); // Phát video khi lướt đến
            } else {
                video.pause(); // Dừng video khi rời khỏi viewport
            }
        });
    }, {
        threshold: 0.5 // Video phải hiển thị ít nhất 50% để phát
    });

    // Theo dõi video
    observer.observe(video);
});
