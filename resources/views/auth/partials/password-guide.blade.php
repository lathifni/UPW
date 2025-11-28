{{-- File ini menerima variabel $inputId dari parent view --}}

@push('styles')
    <style>
        .password-guide {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 16px;
            margin: 12px 0;
            font-size: 14px;
        }

        .criteria-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .criteria-item {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .criteria-icon {
            margin-right: 8px;
            font-size: 16px;
            width: 20px;
            /* Lebar tetap agar rapi */
            text-align: center;
        }

        /* Style untuk icon (menggunakan class bawaan Bootstrap) */
        .criteria-icon.valid {
            color: #198754;
            /* Hijau */
        }

        .criteria-icon.invalid {
            color: #dc3545;
            /* Merah */
        }

        /* Style untuk teks */
        .criteria-text.valid {
            color: #198754;
            /* Hijau */
            font-weight: 500;
            text-decoration: line-through;
        }

        .criteria-text.invalid {
            color: #6c757d;
            /* Abu-abu */
        }
    </style>
@endpush

<div class="password-guide">
    <ul class="criteria-list">
        <li class="criteria-item" id="criteria-length">
            <span class="criteria-icon invalid"><i class="bi bi-x-lg"></i></span>
            <span class="criteria-text invalid">Minimal 8 karakter</span>
        </li>
        <li class="criteria-item" id="criteria-case">
            <span class="criteria-icon invalid"><i class="bi bi-x-lg"></i></span>
            <span class="criteria-text invalid">Huruf besar (A-Z) dan kecil (a-z)</span>
        </li>
        <li class="criteria-item" id="criteria-number">
            <span class="criteria-icon invalid"><i class="bi bi-x-lg"></i></span>
            <span class="criteria-text invalid">Sertakan angka (0-9)</span>
        </li>
        <li class="criteria-item" id="criteria-symbol">
            <span class="criteria-icon invalid"><i class="bi bi-x-lg"></i></span>
            <span class="criteria-text invalid">Sertakan simbol (cth: !@#$)</span>
        </li>
    </ul>
</div>

@push('scripts')
    <script>
        if (typeof passwordValidatorAttached === 'undefined') {
            passwordValidatorAttached = true;

            document.querySelectorAll('[data-password-validate]').forEach(passwordInput => {
                const form = passwordInput.closest('form');
                if (!form) return;
                const guide = form.querySelector('.password-guide');
                if (guide) {
                    const criteriaLength = guide.querySelector('#criteria-length');
                    const criteriaCase = guide.querySelector('#criteria-case');
                    const criteriaNumber = guide.querySelector('#criteria-number');
                    const criteriaSymbol = guide.querySelector('#criteria-symbol');

                    passwordInput.addEventListener('input', function() {
                        const password = this.value;
                        updateCriteria(criteriaLength, password.length >= 8);
                        updateCriteria(criteriaCase, /[a-z]/.test(password) && /[A-Z]/.test(password));
                        updateCriteria(criteriaNumber, /[0-9]/.test(password));
                        updateCriteria(criteriaSymbol, /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(
                            password));
                    });
                }

                const confirmInput = form.querySelector('[name="password_confirmation"]');
                if (confirmInput) {
                    const statusDiv = form.querySelector('.password-confirmation-status');

                    if (statusDiv) {
                        const validateConfirmation = () => {
                            const pass1 = passwordInput.value;
                            const pass2 = confirmInput.value;

                            if (pass2.length === 0) {
                                statusDiv.innerHTML = '';
                            } else if (pass1 === pass2) {
                                statusDiv.innerHTML =
                                    '<span class="text-success"><i class="bi bi-check-lg"></i> Password cocok!</span>';
                            } else {
                                statusDiv.innerHTML =
                                    '<span class="text-danger"><i class="bi bi-x-lg"></i> Password tidak cocok.</span>';
                            }
                        };

                        passwordInput.addEventListener('input', validateConfirmation);
                        confirmInput.addEventListener('input', validateConfirmation);
                    }
                }
            });

            function updateCriteria(element, isValid) {
                if (!element) return;
                const iconElement = element.querySelector('.criteria-icon');
                const textElement = element.querySelector('.criteria-text');
                iconElement.innerHTML = isValid ? '<i class="bi bi-check-lg"></i>' : '<i class="bi bi-x-lg"></i>';
                iconElement.className = 'criteria-icon ' + (isValid ? 'valid' : 'invalid');
                textElement.className = 'criteria-text ' + (isValid ? 'valid' : 'invalid');
            }
        }
    </script>
@endpush
