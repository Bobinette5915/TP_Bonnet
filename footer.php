        <!-- Footer-->
        <footer style="background: linear-gradient(25deg, #8600b3 50%, #cc33ff 50%);" class="py-5">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Bobinette DWWM 2024</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>


<script>
    const labels = document.querySelectorAll('.form-control label');

labels.forEach(label => {
  label.innerHTML = label.innerText.split("").map((letter, idx) =>`<span style="transition-delay:${idx * 50}ms">${letter}</span>`).join('');
})    
    
    </script>
</html>
