<html>
<head>

    <script src="{{asset('user/js/vendor/jquery-2.2.4.min.js')}}"></script>

    <script src="{{asset('user/js/bootstrap.min.js')}}"></script>











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
                 <a href="#" target="_blank"><img src="{{asset('backend/1603219972.jpg')}}" width="800" height="100"  alt="Logo" align="center" border="0"></a>
         
        </center>
    </header>
    <div id="capture" style="padding: 10px; background: white" width="400" height="300">


    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="100%" style="padding: 0px; text-align: center;">
            </td>
        </tr>
        <tr>
            <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
             <b style="color: rgb(34, 158, 34)">FICHE D'INSCRIPTION/REGISTRATION FORM</b> 
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
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">

        <tr>
            <td width="100%" style="text-align: left; font-size: 15px; font-weight: bold; padding: 0px;">
                <b style="color: rgb(34, 158, 34)">1. INFORMATIONS PERSONNELLES DU CANDIDAT/PERSONAL INFORMATIONS OF CANDIDATE</b>   
            </td>
        </tr>
    </table>

    <table width="100%" style="font-family: sans-serif; font-size: 14px;" >
        <tr>
            <td>
                <table width="100%" style="font-family: sans-serif; font-size: 11px;" >
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Nom(s)Prenom(s)/Name(s)Surname(s)::</strong> {{$data->id}}</td>
                    </tr>


                </table>
                <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:50%;"><strong>Date de naissance/ Date of birth: {{--$Etudiant->DATE_NAISS_ETUD--}}</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:50%;"><strong>Lieux de naissance/ Birthplace:</strong> {{--$Etudiant->LIEU_NAISS_ETUD--}}</td>
                    </tr>

                </table>
                <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

                    <tr>
                         <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:50%;"><strong>Nationalité/ Nationality:</strong> {{--$Etudiant->CODE_PAYS_NATIONALITE--}}</td>
                       <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Region/ Region:</strong> {{--$Etudiant->CODE_PROVINCE_ORIGINE--}}</td>
                      
                    </tr>

                </table>

                <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;width:33%;"><strong>Quartier/City:</strong> {{--$Etudiant->QUARTIER--}}</td>
                       
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
                <b style="color: rgb(34, 158, 34)"> 2. INFORMATIONS FAMILLIALES/FAMILLY INFORMATIONS</b>
            </td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Nom du parent/ tuteur :</strong> {{--$Etudiant->NOM_PARENT1--}}</td>
           <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Contact/ phone(s) Number:</strong> {{--$Etudiant->TELEPHONE_PARENT1--}}</td>
            </tr>


    </table>
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Autre personne à contacter en cas d'urgence :</strong> {{--$Etudiant->NOM_PARENT2--}}</td>
            
          </tr>

    </table>





    <table width="100%" style="font-family: sans-serif;" cellpadding="10">

        <tr>
            <td width="100%" style="text-align: left; font-size: 15px; font-weight: bold; padding: 0px;">
                <b style="color: rgb(34, 158, 34)">3. LANGUE/LANGAGE</b>  
            </td>
        </tr>
    </table>

    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >
        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:25%;"><strong>Français/ French : {{--$Etudiant->LANGUE--}}</strong></td>
        </tr>

        <tr>
   </tr>


    </table>

    
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">

        <tr>
            <td width="100%" style="text-align: left; font-size: 15px; font-weight: bold; padding: 0px;">
                <b style="color: rgb(34, 158, 34)">4.INFORMATIONS SCOLAIRES OU ACADEMIQUES/SCHOOL OR ACADEMIC INFORMATION</b> 
            </td>
        </tr>

    </table>
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Diplôme Academique / Academic Diploma:</strong> {{--$Etudiant->DIPLOME_ADM--}}</td>
            </tr>
            <tr>
                <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Diplôme Professionnel (le cas echeant) / Professionnal Diploma (if you have):</strong> {{--$Etudiant->DIPLOME_ADM2--}}</td>
            </tr>

    </table>
    
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >
        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Specialités choisie/ Speciality selected :</strong>  {{--$Etudiant->DEPARTEMENT_ADM--}}{{----}}</td>
        </tr>


    </table>
   
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">

        <tr>
            <td width="100%" style="text-align: left; font-size: 15px; font-weight: bold; padding: 0px;">
                <b style="color: rgb(34, 158, 34)">5.INFORMATIONS SUPPLEMENTAIRES/OTHERS INFORMATIONS</b> 
            </td>
        </tr>

    </table>
    

    
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >
        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Où avez vous entendu parler de IFPP?/ where did you hear about IFPP? :</strong>  {{--$Etudiant->INFO_I--}}</td>
        </tr>
        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Quelles sont vos attentes à la fin de la formation?/ what are your expectation after training? :</strong>  {{--$Etudiant->ATTENTE--}}</td>
        </tr>
        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Etes-vous apte ou inapte aux activités sportives? /Are you fit or unfit for sporting activities?: :</strong>  {{--$Etudiant->APT--}}</td>
        </tr>


    </table>
    

    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >
        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong>Avez vous une anomalie recurente? Si oui laquelle?/ Do you have a recurring anomaly? If yes which one? :</strong>  {{--$Etudiant->ANOMALIE--}}</td>
        </tr>
        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;" width="100%"><strong>Acceptez-vous de respecter et de vous soumettre au Reglement Interieur de IFPP? / Do you agree to respect and submit to the IFPP internal rules?:</strong> {{--$Etudiant->ACCEPTATION--}}</td>
     </tr>

    </table>
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >

        <tr>
              <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;" width="100%"><strong>Certifiez-vous et attestez-vous que les information communiquées ici sont exactes? /Do you certify and accept that the information communicated here is correct?:</strong> {{--$Etudiant->CERTIFICATION--}}</td>
        </tr>

    </table>
    
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >
        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:100%;"><strong> <i> Je soussigné(e), Mme/Mlle/M:</i></strong> {{--$Etudiant->NOM_ETUDI--}} <strong><i>atteste sur l’honneur l’exactitude des renseignements mentionnés sur ce document.:</i></strong> </td>

           <br><br>
            </tr>
    </table>
    <table width="100%" style="font-family: sans-serif; font-size: 11px;" >
     

        <tr>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Date :</strong> {{--$Etudiant->DATE_SAISIE--}}</td>
            <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px; width:50%;"><strong>Signature:</strong> {{--$Etudiant->NOM_ETUDI--}}</td>
        </tr>
       

    </table>
    <br><br>

    <center> <img src="{{asset('site/img/F_IFPP.png')}}" width="800px" height="66px"  alt="Logo" align="center" border="0"></center>


</div>















    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
          <center>
          <p> <b> veuillez cliquer sur enregister pour générer et telechargarger votre fiche d'inscription </b> </p>
        </center>
        </div>

        <center>
            <a class="" href="{{  URL::to('/admin/scolarites/reu_pdf') }}"><button  class="btn btn-success">Enregistrer le fichier PDF </button></a>
            {{-- <button onclick="window.print()">Lancer l'impression</button>
           <button onclick="window.print()">Lancer l'impression</button>location.reload(true);  --}}
           
        </center>

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
