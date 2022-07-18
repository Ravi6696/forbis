@extends('admin_layouts.main')
@section('content')
    <div class="foorbis-penal scrollbar" id="foorbis-penal">

        <div class="foorbis-penal-all scrollbar">
            <div class="row">
                <!-- foorbis-penal-left Start  -->
                <div class="foorbis-penal-left">
                    <div class="foorbis-switch">
                        <h5>
                            MES ANNOUNCES
                        </h5>
                        <div class="btnbox">
                            <div id="announces" class="btn notactive">
                                Announces
                            </div>
                            <div id="mes" class="btn active">
                                Mes announces
                            </div>
                        </div>
                    </div>


                    <!-- Search panel Start -->
                    <div class="foorbis-search">
                        <div class="searchbox">
                            <img class="searchImg" src="images/search.png" alt="">
                            <input type="text" placeholder="Recherche " class="searchField">
                        </div>
                        <div class="btn" id="createBtn1">
                            <img class="plusImg" src="images/plus-round.png" alt="">
                            Créer une Annonces
                        </div>
                    </div>
                    <!-- search panel End -->

                    <hr>

                    <a href="" class="nav-link foorbis-btn filter">
                        Filter
                    </a>

                    <!-- Category panel Start  -->
                    <div class="foorbis-category">
                        <label>
                            Categories announces
                        </label>
                        <br>
                        <div class=" category-btn">
                            <img src="images/category.png" class="categoryImg" alt="">
                            <select name="cars" id="category-select">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                            <img src="images/right.png" class="rightImg" alt="">
                        </div>
                        <div class="selectedCategories">
                            <div class="category">
                                Category 1
                                <img src="images/remove.png" class="removeImg" alt="">
                            </div>
                            <div class="category">
                                Category 1
                                <img src="images/remove.png" class="removeImg" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- category panel end -->

                    <!-- ANNOUNCES Panel Start  -->
                    <div class="foorbis-announces">
                        <label>
                            2 Announces
                        </label>
                        <br>
                        <hr>

                        <div class="cards scrollbar">
                            <div class="card">
                                <div class="upr">
                                    <img src="images/card1.png" alt="">
                                </div>
                                <div class="lower">
                                    <h4>
                                        Nom de l'annonce
                                    </h4>
                                    <h5>
                                        Catégorie annonce
                                    </h5>
                                    <h6>
                                        date
                                    </h6>
                                    <a href="" class="card-btn">Ne pas renouveler</a>
                                </div>
                            </div>

                            <div class="card">
                                <div class="upr">
                                    <img src="images/card2.png" alt="">
                                </div>
                                <div class="lower">
                                    <h4>
                                        Nom de l'annonce
                                    </h4>
                                    <h5>
                                        Catégorie annonce
                                    </h5>
                                    <h6>
                                        date
                                    </h6>
                                    <a href="" class="card-btn">Ne pas renouveler</a>

                                </div>
                            </div>

                            <div class="card">
                                <div class="upr">
                                    <img src="images/card2.png" alt="">
                                </div>
                                <div class="lower">
                                    <h4>
                                        Nom de l'annonce
                                    </h4>
                                    <h5>
                                        Catégorie annonce
                                    </h5>
                                    <h6>
                                        date
                                    </h6>
                                    <a href="" class="card-btn">Ne pas renouveler</a>

                                </div>
                            </div>

                            <div class="add-card" id="createBtn2">
                                <img src="images/plusCard.png" class="plusCard" alt="">
                                <p>
                                    Nouvelle
                                    annonce
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- ANNOUNCES Panel End  -->
                </div>
                <!-- foorbis-penal-left ENd -->


                <!-- foorbis-penal-right start -->
                <div class="foorbis-penal-right">
                    <div class="card">
                        <div class="upr">
                            <img src="images/card1.png" alt="">
                        </div>
                        <div class="lower">
                            <div class="header">
                                <div class="first">
                                    <img src="images/logo.png" alt="">
                                </div>
                                <div class="second">
                                    <h5>
                                        Nom de l'entreprise
                                    </h5>
                                    <p>
                                        <img src="images/location2.png" alt="">
                                        Address
                                    </p>
                                </div>
                                <div class="label">
                                    Ouvert
                                </div>
                            </div>
                            <hr>
                            <div class="content">
                                <h4>
                                    Titre de l'annonce
                                </h4>
                                <h6>
                                    Catégorie annonce
                                </h6>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tincidunt
                                    augue accumsan,
                                    ultricies nulla quis, dignissim magna. Nunc pellentesque augue at metus
                                    pulvinar, mollis venenatis
                                    libero aliquam. Sed viverra ligula in

                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tincidunt
                                    augue accumsan,
                                    ultricies nulla quis, dignissim magna. Nunc pellentesque augue at metus
                                    pulvinar, mollis venenatis
                                    libero aliquam. Sed viverra ligula in
                                </p>
                                <div class="btnbox">
                                    <a href="" class="foorbis-btn">Mettre à jour</a>
                                </div>
                            </div>
                        </div>
                        <div class="cardFooter">
                            <div class="btnbox">
                                <a href="">
                                    <img src="images/share.png" alt="">
                                    Partager
                                </a>
                            </div>
                            <div class="social">
                                <div class="box fb">
                                    <a href="">
                                        <img src="images/fb.png" alt="">
                                    </a>
                                    12
                                </div>
                                <div class="box insta">
                                    <a href="">
                                        <img src="images/insta.png" alt="">
                                    </a>
                                    15
                                </div>
                                <div class="box twitter">
                                    <a href="">
                                        <img src="images/twiter.png" alt="">
                                    </a>
                                    24
                                </div>
                                <div class="box linkedin">
                                    <a href="">
                                        <img src="images/linkdin.png" alt="">
                                    </a>
                                    35
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- foorbis-penal-right ENd -->
            </div>
        </div>

        <div class="createPopup" id="createPopup">
            <div class="card" id="popupCard">


                <div class="header">
                    <p>
                        Nouvelle Annonce
                    </p>
                    <img src="images/close-icon.png" class="closePopup" id="closePopup" alt="">
                </div>


                <hr>


                <p class="detail">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam rhoncus libero ut lectus porta
                    gravida. Nunc
                    sit amet tellus imperdiet, dapibus nunc eu, vestibulum quam. Aliquam et tincidunt sem. Duis
                    molestie
                    congue ante sed porta. Fusce mauris
                    felis, malesuada ut sagittis ut, vulputate sed metus. Phasellus sem magna, tristique ut leo
                    at, dapibus
                    rhoncus arcu. Fusce ultricies
                    varius congue. Aliquam quis varius mauris. Suspendisse id placerat justo, commodo
                    pellentesque massa.
                </p>


                <div class="date">
                    <div class="left">
                        <p>
                            Nouvelle annonce : <span> numéro 08</span>
                        </p>
                    </div>
                    <div class="right">
                        <p>
                            Date de création | Prochain renouvellement
                        </p>
                    </div>
                </div>


                <div class="transaction">
                    <div class="left">
                        <p class="title">
                            VOTRE SOLDE ACTUEL
                        </p>
                        <p class="amount">
                            35 EURO
                        </p>
                    </div>
                    <div class="center">
                        <img src="images/right-aero.png" alt="">
                    </div>
                    <div class="right">
                        <p class="title">
                            VOTRE NOUVEAU SOLDE
                        </p>
                        <p class="amount">
                            40 EURO
                        </p>
                    </div>
                </div>

                <hr>

                <div class="methods">
                    <p class="left">
                        Moyens de paiement
                    </p>
                    <div class="right">
                        <img src="images/plus_Purple.png" alt="">
                        Ajouter un nouveau
                    </div>
                </div>


                <div class="masterCard">
                    <div class="image">
                        <img src="images/mastercard.png" alt="">
                    </div>
                    <div class="number">
                        <p>
                            Se terminant par ... 0000
                        </p>
                    </div>
                    <div class="expiry">
                        <p>
                            Expire le 01/23
                        </p>
                    </div>
                    <div class="name">
                        <p>
                            mettre à jour
                        </p>
                    </div>
                    <div class="status">
                        <p>
                            Supprimer
                        </p>
                    </div>
                </div>


                <div class="condition">
                    <div class="left">
                        <input type="checkbox" id="conditions">
                        J'accepte les conditions générales de ventes
                    </div>
                    <div class="right">
                        <a href="" class="foorbis-btn submitBtn">
                            Commander
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
