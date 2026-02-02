document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('[data-target]');
    let activeInput = null;
    let activeButton = null;

    buttons.forEach(btn => {
        const input = document.getElementById(btn.dataset.target);

        btn.addEventListener('click', () => {
            if (activeInput === input) {
                input.form.submit();
                return;
            }

            if (activeInput && activeButton) {
                activeInput.disabled = true;
                activeButton.classList.remove('btn-send');
                activeButton.classList.add('btn-disabled');
            }

            // Ativa o novo campo
            input.disabled = false;
            input.focus();

            btn.classList.remove('btn-disabled');
            btn.classList.add('btn-send');
            btn.innerHTML = 'Enviar';

            activeInput = input;
            activeButton = btn;
        });

        input.addEventListener('keydown', e => {
            if (e.key === 'Enter') {
                e.preventDefault();
                input.form.submit();
            }
        });
    });

    document.getElementById('btnDeleteAccount').addEventListener('click', () => {
        Swal.fire({
            title: 'Tem certeza?',
            text: 'Sua conta será desativada e você será deslogado.',
            icon: 'warning',
            background: '#0f0f0f',
            color: '#ffffff',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#374151',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAccountForm').submit();
            }
        });
    });

});


document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('lang');
    if (!btn) return;
    let lang = document.documentElement.getAttribute('lang') || 'pt';
    btn.textContent = lang.toUpperCase();

    btn.addEventListener('click', async () => {
        lang = lang === 'en' ? 'pt' : 'en';
        btn.textContent = lang.toUpperCase();

        await fetch('/set-language', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ lang })
        });

        window.location.reload();
    });
}); 