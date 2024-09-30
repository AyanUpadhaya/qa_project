<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script>
    document.querySelector('.btn-danger').addEventListener('click', function (e) {
        if (!confirm('Are you sure?')) {
            e.preventDefault();
        }
    });
</script>
</body>

</html>