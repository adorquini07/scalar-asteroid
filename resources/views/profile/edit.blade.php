<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-5 text-white mb-0">Mi Perfil</h2>
    </x-slot>

    <div class="container-xl py-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="card border-secondary" style="background-color: #0d0d0d;">
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card border-secondary" style="background-color: #0d0d0d;">
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card border-secondary" style="background-color: #0d0d0d;">
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>