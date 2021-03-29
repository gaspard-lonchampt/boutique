

<script type="text/javascript">document.addEventListener('DOMContentLoaded', () => {

  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {

        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById(target);

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

});</script>

</body>
<footer class="footer">
<div class="navbar-item">
        <a class="navbar-item">
          En savoir plus
        </a>

          <a class="navbar-item">
            A propos
          </a>
          <a class="navbar-item">
            Condition général de vente
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Service après vente
          </a>
      </div>
   

  <div class="navbar-end">
    <p>
      <strong>Bateau Louche</strong> by <a href="">Marie Clerc & Gaspard Lonchampt</a>.
    </p>
  </div>
   </div>
</footer>
