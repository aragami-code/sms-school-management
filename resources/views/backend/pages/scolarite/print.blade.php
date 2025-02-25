<html>
<head>

    <script src="{{asset('user/js/vendor/jquery-2.2.4.min.js')}}"></script>

    <script src="{{asset('user/js/bootstrap.min.js')}}"></script>




    <div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <center>
  <p> <b> veuillez cliquer sur enregister pour générer et telechargarger votre fiche d'inscription </b> </p>
</center>
</div>

<center>
    <a class="" href="{{  URL::to('/admin/reu_pdf') }}"><button  class="btn btn-success">Enregistrer le fichier PDF </button></a>
    {{-- <button onclick="window.print()">Lancer l'impression</button>
   <button onclick="window.print()">Lancer l'impression</button>location.reload(true);  --}}
   
</center>

</div>






<style>
    body {
        font-family: sans-serif;
        font-size: 10pt;
    }

    p {
        margin: 0pt;
    }

    table.items {
        border: 0.1mm solid #e7e7e7;
    }

    td {
        vertical-align: top;
    }

    .items td {
        border-left: 0.1mm solid #e7e7e7;
        border-right: 0.1mm solid #e7e7e7;
    }

    table thead td {
        text-align: center;
        border: 0.1mm solid #e7e7e7;
    }

    .items td.blanktotal {
        background-color: #EEEEEE;
        border: 0.1mm solid #e7e7e7;
        background-color: #FFFFFF;
        border: 0mm none #e7e7e7;
        border-top: 0.1mm solid #e7e7e7;
        border-right: 0.1mm solid #e7e7e7;
    }

    .items td.totals {
        text-align: right;
        border: 0.1mm solid #e7e7e7;
    }

    .items td.cost {
        text-align: "."center;
    }
    </style>

</head>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
    </style>

<body>
    <header>
        <center>
                 <a href="#" target="_blank"><img src="{{asset('backend/images/doc/ISSAM_Institut_Logo_200.JPEG')}}" width="800" height="100"  alt="Logo" align="center" border="0"></a>
         
        </center>
    </header>
    <div id="capture" style="padding: 10px; background: white" width="400" height="300">

    <a href="#" target="_blank"><img src="{{ public_path('images/doc/ISSAM_Institut_Logo_200.jpeg') }}" width="800" height="100"  alt="Logo" align="center" border="0"></a>
         
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="100%" style="padding: 0px; text-align: center;">
            </td>
        </tr>
        <tr>
            <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
             <b style="color: rgb(34, 158, 34)">RECU DE PAYEMENTRR {{$Etudiant->code_recu}}{{$Etudiant->id}} </b> 
            </td>
        </tr>

    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">

        <tr>
            <td width="100%" style="text-align: left; font-size: 15px; font-weight: bold; padding: 0px;">
             </td>
        </tr>
        <tr>
            <td width="100%" style="text-align: left; font-size: 15px; font-weight: bold; padding: 0px;">
             </td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

        <tr>
            
               <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Annee Academique/Academic Year</strong> {{$Etudiant->slug_annee}}</td>
                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Nom(s)de l'operateur /Name(s)of operator ::</strong> {{$Etudiant->name}}</td>
                  
            </td>
        </tr>
    </table>

    <table width="100%" style="font-family: sans-serif; font-size: 14px;" >
        <tr>
            <td>
                <table width="100%" style="font-family: sans-serif; font-size: 11px;" >
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Nom(s)Prenom(s)/Name(s)Surname(s)::</strong> {{$Etudiant->nom_prenom}}</td>
                       </tr>


                </table>
                <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:50%;"><strong>Matricule: {{$Etudiant->matricule}}</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:50%;"><strong>Date de l'operation/ date of operation:</strong> {{$Etudiant->created_at}}</td>
                    </tr>

                </table>
                <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

                    <tr>
                         <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:50%;"><strong>Classe/ Classes:</strong> {{$Etudiant->name_classes}}</td>
                       <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Mode de payement/ Payment method:</strong> {{--$Etudiant->CODE_PROVINCE_ORIGINE--}}</td>
                      
                    </tr>

                </table>

                <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:33%;"><strong>Section/Sections:</strong> {{$Etudiant->nom_section}}</td>
                       
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:33%;"><strong>Genre/Gender:</strong> {{--$Etudiant->SEXE_ETUD--}}</td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:33%;"><strong>Statut/Status :</strong>{{--$Etudiant->SIT_MAT_ETUD--}}</td>
                
                    </tr>

                </table>
                <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Numero de telephone/Phone number :</strong> {{--$Etudiant->TELEPHONE_PER--}}</td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Email/E-mail:</strong> {{--$Etudiant->EMAIL_PER--}}</td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">

        <tr>
            <td width="100%" style="text-align: left; font-size: 15px; font-weight: bold; padding: 0px;">
                <b style="color: rgb(34, 158, 34)">  MOTIF DU VERSEMENT/VERSEMENT CONDITION</b>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Montant des droits universitaires/  :  {{$Etudiant->scolarite_total}} {{$parametre->devise_monetaire}}</strong> </td>
           <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Montant en lettre:</strong> <?php
                          $t = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
                          echo $t->format($Etudiant->scolarite_total);
                         // $//td = Carbon::now()->format();
                         //$diff = Carbon\Carbon::parse($articles->created_at)->diffForHumans();
                         ?></td>
            </tr>


    </table>
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Montant cumulé/  : {{$Etudiant->scolarite_cumul}} {{$parametre->devise_monetaire}}</strong> </td>
           <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Montant en lettre:</strong> <?php
                          $t = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
                          echo $t->format($Etudiant->scolarite_cumul);
                         // $//td = Carbon::now()->format();
                         //$diff = Carbon\Carbon::parse($articles->created_at)->diffForHumans();
                         ?></td>
            </tr>


    </table>
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

<tr>
    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Montant du versement/  :          {{$Etudiant->montant_versement_jour}} {{$parametre->devise_monetaire}}</strong></td>
   <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Montant en lettre:</strong><?php
                          $t = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
                          echo $t->format($Etudiant->montant_versement_jour);
                         // $//td = Carbon::now()->format();
                         //$diff = Carbon\Carbon::parse($articles->created_at)->diffForHumans();
                         ?></td>
    </tr>


</table>
<table width="100%" style="font-family: sans-serif; font-size: 11px;" >

<tr>
    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Reste à payer/  :  {{$Etudiant->reste_scolarite}} {{$parametre->devise_monetaire}}</strong> </td>
   <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Montant en lettre:</strong>   <?php
                          $t = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
                          echo $t->format($Etudiant->reste_scolarite);
                         // $//td = Carbon::now()->format();
                         //$diff = Carbon\Carbon::parse($articles->created_at)->diffForHumans();
                         ?></td>
    </tr>


</table>

<table width="100%" style="font-family: sans-serif; font-size: 13px;" >
     

     <tr>
          <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong> <center> Signataires</center></strong> {{--$Etudiant->NOM_ETUDI--}}</td>
     </tr>
    

 </table>

<table width="100%" style="font-family: sans-serif; font-size: 11px;" >

<tr>
    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:33%;"><strong> <center>caissiere: </center>  </strong> </td>
   
    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:33%;"><strong> <center>client:</center>  </strong> </td>
    <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:33%;"><strong> <center> comptable :</center></strong></td>

</tr>
</table>

    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >
     
    <?php
                          $dt = Carbon\Carbon::now()->format('d/m/Y');
                         // $//td = Carbon::now()->format();
                         //$diff = Carbon\Carbon::parse($articles->created_at)->diffForHumans();
                         ?>
        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Date d'impression :</strong> {{$dt}}</td>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>identifiant:</strong> {{--$Etudiant->NOM_ETUDI--}}</td>
        </tr>
       

    </table>
    <br><br>

    <center> <img src="{{asset('backend/images/doc/g1.PNG')}}" width="800px" height="66px"  alt="Logo" align="center" border="0"></center>


</div>















 
      <script type="text/javascript">
        $(window).on('load', function() {
            $('#myModal').modal({backdrop:'static', keyboard:false},'show');
        });
        
    </script>

      <script>
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
      </script>




















<script>

</script>





</body>
</html>
