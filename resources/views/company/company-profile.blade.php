<x-frontend.layout>
    @push('styles')
    <style>
        .btn-submit {
            text-align: right;
            margin-top: 30px;
        }

        .error {
            color: red;
        }

        .hidden {
            display: none;
        }

        .alert {
            font-size: 25px;
            color: rgb(253, 13, 13)
        }
    </style>
    @endpush
    <div class="foorbis-penal scrollbar">
        <div class="foorbis-penal-all scrollbar">
            <div class="top-bar row">
                <p class="dashbord-name col-12">FICHE ENTREPRISE</p>
            </div>
            <x-company-preview />
        </div>
    </div>
</x-frontend.layout>
