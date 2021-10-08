<div class="col-lg-4">
    <span class="requirement-span">*</span>
    <input type="text" name="first_name" id="first_name" value="{{ $user->first_name ?? '' }}" placeholder="Nom">
    <p class="error" id="error_first_name"></p>
</div>
<div class="col-lg-4">
    <span class="requirement-span">*</span>
    <input type="text" name="last_name" id="last_name" value="{{ $user->last_name ?? '' }}" placeholder="prenom">
    <p class="error" id="error_last_name"></p>

</div>
<div class="col-lg-4">
    <span class="requirement-span"></span>
    <input type="text" name="company_name" value="{{ $company->name ?? '' }}" id="company_name"
        placeholder="Entreprise">
    <p class="error" id="error_company_name"></p>
</div>
<div class="col-lg-4">
    <span class="requirement-span"></span>
    <input type="text" name="address_line_1" value="{{ $address->address_line_1 ?? '' }}" id="address_line_1"
        placeholder="SIRET">
    <p class="error" id="error_address_line_1"></p>
</div>
<div class="col-lg-8">
    <span class="requirement-span">*</span>
    <input type="email" name="email" value="{{ $company->email ?? '' }}" placeholder="Mail">
    <p class="error" id="error_email"></p>
</div>
<div class="col-lg-4">
    <span class="requirement-span">*</span>
    <input type="text" name="address_line_2" value="{{ $address->address_line_2 ?? '' }}" placeholder="Address">
    <p class="error" id="error_address_line_2"></p>
</div>
<div class="col-lg-4">
    <span class="requirement-span">*</span>
    <input type="text" name="city" value="{{ $address->city ?? '' }}" placeholder="Ville">
    <p class="error" id="error_city"></p>
</div>
<div class="col-lg-4">
    <span class="requirement-span">*</span>
    <input type="text" name="postal_code" value="{{ $address->postalcode ?? '' }}" placeholder="Code Postal">
    <p class="error" id="error_postal_code"></p>
</div>
