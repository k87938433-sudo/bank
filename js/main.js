document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('news-search');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search.php?q=' + encodeURIComponent(q));
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('news-list').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    }
});
