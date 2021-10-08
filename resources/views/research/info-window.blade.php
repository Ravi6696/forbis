<div>
    <div class="enterprice-slide">
        <div class="enterprice-img"><img src="images/sub-thumbe-4.png"></div>
        <div class="centerprice-col">
            <a class="entreprise-heading" href="javascript:;">{{ $companyDetail->name ?? '-' }}</a>
            <span class="ouvert">ouvert</span>
            <a class="categorie categorie-recherch" href="#"><img
                    src="images/pink-menu.png">
                    {{ $companyDetail->category_name ?? '-' }}
            </a>
            <a href="javascript:;"><img
                    src="images/location-perpal.png">
                {{ $companyDetail->full_address ?? '-' }}</a>
            <a class="favorle-recherch" href="javascript:;"><img src="images/favoris.png"> Favorle</a>
        </div>
    </div>
</div>