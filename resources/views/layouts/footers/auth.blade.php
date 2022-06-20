@desktop
<footer class="footer">
  <div class="container-fluid">
    <nav class="float-left">

    </nav>
    <div class="copyright float-right">

    </div>
  </div>
</footer>
@enddesktop
@push('js')
<script>
    $(document).ready(function (){
        $('.copyright').text("©" + new Date().getFullYear())
    })
</script>
@endpush
