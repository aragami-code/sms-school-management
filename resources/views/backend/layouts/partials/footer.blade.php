<footer>
    <div class="footer-area">
       
       @php

        $parametre  = \App\Parametres::first();
   @endphp 
        <p>© Copyright {{$parametre->annee}}. All right reserved.  by <a href="#">{{$parametre->copyright}}</a>.</p>


    </div>
</footer>
