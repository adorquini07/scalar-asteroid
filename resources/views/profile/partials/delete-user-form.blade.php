<section>
    <h2 class="fw-semibold fs-5 text-white mb-1">Eliminar cuenta</h2>
    <p class="text-secondary small mb-4">Una vez eliminada, todos los datos seran borrados permanentemente.</p>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
        Eliminar cuenta
    </button>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border border-secondary text-white">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title">Confirmar eliminacion</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-secondary small">Esta accion no se puede deshacer. Ingresa tu contrasena para confirmar.</p>
                        <x-input-label for="delete_password" value="Contrasena" />
                        <x-text-input id="delete_password" name="password" type="password" placeholder="Contrasena" />
                        <x-input-error :messages="$errors->userDeletion->get('password')" />
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <x-danger-button>Eliminar cuenta</x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>