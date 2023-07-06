<x-guest-layout>

    @unless ($errors->isEmpty())
    {{-- Ainda precisa pegar o erro de que o cpf ou o email já existem sem que este erro seja passado claramente ao usuário.
        Queria pegar pelo tipo do constraint que foi quebrado...
        Escrever algo como "Ooopss parece que você já possui um cadastro em nosso site! Tente recuperar seu login e senha" --}}
        <p>Corrija os seguintes erros no seu formulário:</p>
        <ul>
            @foreach ($errors->all() as $message)
                <li>{{$message}}</li>
            @endforeach
        </ul>
    @endunless

    <form id="form" method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Circles which indicates the steps of the form: -->
        <div>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <!-- <span class="step"></span> -->
        </div>

        <!-- One "tab" for each step in the form: -->
        <div class="tab">
            
            <fieldset class="register-form identification">
                <legend>Dados para identificação:</legend>

                <!-- Nome -->
                <div>
                    <label for="firstname" class="form-label">Nome:</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}" placeholder="Nome" pattern="[a-zA-Z].{2,}" autocomplete="given-name" required>
                    <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                    <div class="error invalid-feedback">Insira o seu nome</div>
                </div>    

                <!-- Sobrenome  -->
                <div>
                    <label for="lastname" class="form-label">Sobrenome:</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}" placeholder="Sobrenome" autocomplete="family-name" required pattern="[a-zA-Z].{2,}">
                    <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    <div class="error invalid-feedback">Insira o seu sobrenome</div>
                </div>

                <div class="form-check">
                    <input type="hidden" name="has_social_name" value="0">
                    <input class="form-check-input" type="checkbox" name="has_social_name" id="has_social_name" value="1" {{ old('has_social_name') == 1 ? "checked" : "" }}>    
                    <label for="has_social_name" class="form-check-label">Usar nome social?</label>
                </div>

                <!-- Aqui o javascript tem que captar como um toggle e mudar o hidden para visible e acrescentar o required nos campos abaixo. Talvez usar botão de toggle pra ficar mais legal mesmo -->

                <div id="nome_social" class="d-none">
                    <div class="">
                        <label for="social_firstname" class="form-label">Nome (social):</label>
                        <input type="text" name="social_firstname" id="social_firstname" class="form-control" value="{{ old('social_firstname') }}" placeholder="Nome Social" autocomplete="given-name" >
                        <x-input-error :messages="$errors->get('social_firstname')" class="mt-2 invalid-feedback" />
                        <div class="error invalid-feedback">Insira seu nome social</div>
                    </div>

                    <div>
                        <label for="social_lastname" class="form-label">Sobrenome (social):</label>
                        <input type="text" name="social_lastname" id="social_lastname" class="form-control" value="{{ old('social_lastname') }}" placeholder="Sobrenome Social" autocomplete="family-name" >
                        <x-input-error :messages="$errors->get('social_lastname')" class="mt-2 invalid-feedback" />
                        <div class="error invalid-feedback">Insira seu sobrenome social</div>
                    </div>
                </div>


                <div>
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF sem pontos" value="{{ old('cpf') }}" required pattern="(^\d{3}\x2E*\d{3}\x2E*\d{3}\x2D*\d{2}$)">
                    <x-input-error :messages="$errors->get('cpf')" class="mt-2 invalid-feedback" />
                    <div class="error invalid-feedback">Insira um cpf válido</div>
                </div>

            </fieldset>

            <div class="flex items-center justify-end mt-4">
                <a class="" href="{{ route('login') }}">{{ __('Já possuo cadastro') }}</a>
            </div>

        </div>

        <div class="tab">
            <fieldset class="">
                <legend>Conte-nos mais sobre você!</legend>

                <div>
                    <label for="birth_date" class="form-label">Data de nascimento:</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control" min='{{ date("Y-m-d", strtotime("-120 years")) }}' max="{{ date('Y-m-d') }}" value="{{ old('birth_date') }}" autocomplete="bday" required>
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2 invalid-feedback" />
                    <div class="error invalid-feedback">Informe sua data de nascimento</div>
                </div>


                <!-- Indicadores -->
                @foreach ($indicadores as $indicador)
                <div>
                    <label class="form-label" for="indicador[{{$indicador->id}}]">{{ucwords($indicador->name)}}:</label>
                    <select class="form-select" name="indicador[{{$indicador->id}}]" id="indicador[{{$indicador->id}}]" required>
                        <option value="">Selecione</option>
                        @foreach($indicador->options as $option)
                            <option value="{{$option->id}}" {{ old("indicador[$indicador->id]") == $option->id ? "selected" : ""}} >{{ucfirst($option->name)}}</option>
                        @endforeach
                    </select>
                    <div class="error invalid-feedback">Informe este campo!</div>
                </div>
                @endforeach

            </fieldset> 
        
        </div>

        <div class="tab">
            <fieldset class="register-form login-data">
                <legend>Credenciais de login:</legend>

                <div>
                    <label for="email" class="form-label">Email: </label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Insira seu email" value="{{ old('email') }}" autocomplete="email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 invalid-feedback" />
                    <div class="error invalid-feedback">Informe um email válido</div>
                </div>

                <!-- Peguei esta RegEx do site: https://www.section.io/engineering-education/password-strength-checker-javascript/ 
                    Não sei se está correta! -->
                <div class="row">
                    <div class="col-11">
                        <label for="password" class="form-label">Senha:</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="A senha deve ter no mínimo 8 caracteres, sendo 1 número, 1 letra maiúscula e 1 caractere especial" autocomplete="current-password" required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 invalid-feedback" />
                        <div class="error invalid-feedback">
                            <ul>
                                <li id="mixLength">Mín. 6 caracteres</li>
                                <li id="hasDigit">Mín. 1 número</li>
                                <li id="hasUpperCase">Mín. 1 letra maiúscula</li>
                                <li id="hasSpecialChar">Mín. 1 caractere especial como ! @ # $ % & *</li>
                            </ul>
                        </div>
                    </div>
                    <div class="fs-4 col-1">
                        <i id="see_password" class="bi bi-eye-slash"></i>
                    </div>
                </div>

                <div class="row">                
                    <div class="col-11">
                        <label for="password_confirmation" class="form-label">Confirmar senha:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="Confirme sua senha" required>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 invalid-feedback" />
                        <div class="error invalid-feedback">As senhas não estão iguais!</div>
                    </div>
                    <div class="col-1"> 
                        <i id="see_password_confirm" class="bi bi-eye-slash"></i>
                    </div>
                </div>

            </fieldset>
        </div>

        <div >
            <div >
                <button type="button" id="prevBtn" class="btn btn-primary" onclick="nextPrev(-1)">Anterior</button>
                <button type="button" id="nextBtn" class="btn btn-primary" onclick="nextPrev(1)" disabled>Próximo</button>
            </div>
        </div>


    </form>


    <script>

        // Preciso pegar o valor de cada current tab validation e mudar ela....

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                let valid = true;
                currentInputs = form.querySelectorAll("input");
                currentSelects = form.querySelectorAll("select");
                //foreach input, checkvalidity() against constraints e aí se algum for invalido, seta como invalido
                currentInputs.forEach((input) => {

                    if (! is_valid(input)) {
                        console.log(input.name);
                        input.classList.add('is-invalid');
                        valid = false;
                        
                    }

                })
                currentSelects.forEach((select) => {
                    if (!is_valid(select)) {
                        select.classList.add('is-invalid');
                        valid = false;
                    }
                })
                // If the valid status is true, mark the step as finished and valid:

                if (!valid) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
        })()



        // Usando o exemplo padrão do W3Schools: https://www.w3schools.com/howto/howto_js_form_steps.asp 
        let currentTab = 0; // Current tab is set to be the first tab (0)
        const tabs = document.getElementsByClassName("tab");
        showTab(currentTab); // Display the current tab

        

        function showTab(index) {
        // This function will display the specified tab of the form ...

        tabs[index].style.display = "block";
        // ... and fix the Previous/Next buttons:
        let nextBtn = document.getElementById("nextBtn");
        let prevBtn = document.getElementById("prevBtn");

        if (index == 0) {
            prevBtn.style.display = "none";
        } else {
            prevBtn.style.display = "inline";
        }
        if (index == (tabs.length - 1)) {
            // Aqui poderia mudar o tipo de botão se fosse o caso... Fazer ele nativamente ser um submit e tirar o onclick()
            // Na verdade, vou deixar o botão de enviar aqui, mas escondido, aí só mostra ou esconde ele
            nextBtn.innerText = "Registrar!";
            if (!validateStepAndEnableNext()) {
                nextBtn.disabled = true;
            }
        } else {
            // Aqui tem que fazer voltar ao normal se voltar da tela final, para exibir apenas Próximo e não ser um submit
            nextBtn.innerText = "Próximo";
            nextBtn.type = 'button';
            nextBtn.setAttribute('onclick', 'nextPrev(1)');
            if (!validateStepAndEnableNext()) {
                nextBtn.disabled = true;
            }
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(index)
        }

        function nextPrev(increment) {
        // se n == -1 volta
        // se n == 1 avança
        // This function will figure out which tab to display
        if ((currentTab + increment) >= tabs.length) {
            //...the form gets submitted:
            if(validateForm()) {
                document.getElementById("form").submit();
            }
            //console.log(forms);
            //forms.forEach(form => form.submit());
            return;
        }

        // Exit the function if any field in the current tab is invalid:
        if (increment == 1 && !validateForm()) return false;
        // Hide the current tab:
        tabs[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + increment;
        // if you have reached the end of the form... :
        // Otherwise, display the correct tab:
        showTab(currentTab);
        }


        

        
        // Checar se todos os campos estão ok
        // Essa checagem precisa ser feita a cada input!
        // Ou seja
        // Cada input chama o validate!
        // e, ao final do validate, chama o habilita submit e próximo...
        



        function validate(input) {
            // checkvalidity
            // muda o css para ficar inválido
            //console.log("Validando AGORA: " + input.name);
            if (!is_valid(input)){
                if (input.classList.contains('is-valid')) {
                    input.classList.remove('is-valid');
                }
                if (!input.classList.contains('is-invalid')) {
                    input.classList.add('is-invalid');
                }
            } else {
                if (input.classList.contains('is-invalid')) {
                    input.classList.remove('is-invalid');
                }
            }
            if (input.value === "") {
                if (input.classList.contains('is-invalid')) {
                    input.classList.remove('is-invalid');
                }
                console.log("É vazio");
            }
            if(input.name === 'password') {
                console.log("O input é password");
                let confirmation = form.querySelector('[name="password_confirmation"]');
                console.log(confirmation);
                if (confirmation.value != '' && !is_valid(confirmation)) {
                    if (! confirmation.classList.contains('is-invalid')) {
                        confirmation.classList.add('is-invalid');
                    }
                } else if (is_valid(confirmation)) {
                    confirmation.classList.remove('is-invalid');
                    // if (! confirmation.classList.contains('is-valid')) {
                    //     confirmation.classList.add('is-valid');
                    // }
                }
            }
            validateStepAndEnableNext();
        }




        function validateStepAndEnableNext() {
            let valid = true;
            currentInputs = tabs[currentTab].querySelectorAll("input");
            currentSelects = tabs[currentTab].querySelectorAll("select");
            //foreach input, checkvalidity() against constraints e aí se algum for invalido, seta como invalido
            currentInputs.forEach((input) => {
                if (! is_valid(input)) {
                    valid = false;
                }
            })
            currentSelects.forEach((select) => {
                if (!is_valid(select)) {
                    valid = false;
                }
            })
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                let step = document.getElementsByClassName("step")[currentTab];
                step.classList.add('finish');
                nextBtn.disabled = false;
            }
            else {
                let step = document.getElementsByClassName("step")[currentTab];
                step.classList.remove('finish');
                nextBtn.disabled = true;
            }
            return valid; // return the valid status
        }



        // Validate CPF
        // Retirada de: {site que não lembro}
        // Para entender a regra, ver Macoratti
        function validateCPF(cpf) {	

            //cpf = cpf.replace(/[^\d]+/g,'');	
            if(cpf == '') return false;	

            // Elimina CPFs invalidos conhecidos	
            if (cpf.length != 11 || 
                cpf == "00000000000" || 
                cpf == "11111111111" || 
                cpf == "22222222222" || 
                cpf == "33333333333" || 
                cpf == "44444444444" || 
                cpf == "55555555555" || 
                cpf == "66666666666" || 
                cpf == "77777777777" || 
                cpf == "88888888888" || 
                cpf == "99999999999")
                    return false;		

            // Valida 1o digito	
            // Itera pelos primeiros nove dígitos realizando as multiplicações por valor incremental a partir de 2 e a soma do resultado
            // Divide a soma por 11, aplicando a regra sobre o resto

            add = 0;	
            for (i=0; i < 9; i ++)		
                add += parseInt(cpf.charAt(i)) * (10 - i);	
                rev = 11 - (add % 11);	
                if (rev == 10 || rev == 11)		
                    rev = 0;	
                if (rev != parseInt(cpf.charAt(9)))		
                    return false;

            // Valida 2o digito	
            // Itera pelos primeiros dez dígitos realizando as multiplicações por valor incremental a partir de 2 e a soma do resultado
            // Divide a soma por 11, aplicando a regra sobre o resto

            add = 0;	
            for (i = 0; i < 10; i ++)		
                add += parseInt(cpf.charAt(i)) * (11 - i);	
            rev = 11 - (add % 11);	
            if (rev == 10 || rev == 11)	
                rev = 0;	
            if (rev != parseInt(cpf.charAt(10)))
                return false;		
            return true;   
        }


        // Validate confirm Password
        function validatePasswordConfirmation(password, passwordToMatch) {
            return password === passwordToMatch;
        }



        // Validate Password
        function validatePassword(passwd) {
        // Deveria ser APENAS um regex, mas não fui capaz de entender como faz

            let valid = true;

            let hasDigit = new RegExp(/\d+/);
            let hasUpper = new RegExp(/\p{Lu}/u);
            let minLength = new RegExp(/(\S){6,}/);
            let noSpaces = new RegExp(/^\S*$/);
            let hasSpecialChar = new RegExp(/[#$%&*@!]+/);

            let criterio = document.querySelector('#password ~ .invalid-feedback #hasDigit');

            if (!hasDigit.test(passwd)) {
                if (criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.remove('criterio-atendido');
                }
                valid = false;
            } else {
                if (!criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.add('criterio-atendido');
                }
            }

            criterio = document.querySelector('#password ~ .invalid-feedback #hasUpperCase');
            if (!hasUpper.test(passwd)) {
                if (criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.remove('criterio-atendido');
                }
                valid = false;
            } else {
                if (!criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.add('criterio-atendido');
                }
            }

            criterio = document.querySelector('#password ~ .invalid-feedback #mixLength');
            if (!minLength.test(passwd)) {
                if (criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.remove('criterio-atendido');
                }
                valid = false;
            } else {
                if (!criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.add('criterio-atendido');
                }
            }


            //criterio = document.querySelector('#password ~ .invalid-feedback #hasDigit');
            if (!noSpaces.test(passwd)) {
                // if (criterio.classList.contains('criterio-atendido')) {
                //     criterio.classList.remove('criterio-atendido');
                // }
                valid = false;
            } 
            // else {
            //     if (!criterio.classList.contains('criterio-atendido')) {
            //         criterio.classList.add('criterio-atendido');
            //     }
            // }


            criterio = document.querySelector('#password ~ .invalid-feedback #hasSpecialChar');
            if (!hasSpecialChar.test(passwd)) {
                if (criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.remove('criterio-atendido');
                }
                valid = false;
            } else {
                if (!criterio.classList.contains('criterio-atendido')) {
                    criterio.classList.add('criterio-atendido');
                }
            }

            return valid;

        }

        function is_valid(input) {
            if (input.value === '' && input.required === "true") {
                return false;
            }
            if (input.name === 'cpf') {
                input.value = input.value.replace(/[^\d]+/g,'');
                return validateCPF(input.value);
            } 
            if (input.name === 'password') {
                return validatePassword(input.value);
            }
            if (input.name === 'password_confirmation') {
                let passwordToMatch = form.querySelector('[name="password"]');
                return validatePasswordConfirmation(input.value, passwordToMatch.value);
            }
            return input.checkValidity();
        }
 


        // Adicionar Event Listeners para todos os campos
        // Fetch all the forms
        const forms = document.querySelectorAll('.needs-validation')
        // Get all the inputs and selects on each form
        forms.forEach((form) => {
            let inputs = form.querySelectorAll('input');
            inputs.forEach(input => input.addEventListener('input', () => {
                validate(input);
            }));
            let selects = form.querySelectorAll('select');
            selects.forEach(select => select.addEventListener('change', () => {
                validate(select);
            }));
        })



        // // Adiciona os event listeners
        // (() => {
        // 'use strict'

        // // Fetch all the forms
        // const forms = document.querySelectorAll('.needs-validation')
        // // Get all the inputs and selects on each form
        // forms.forEach((form) => {
        //     let inputs = form.querySelectorAll('input');
        //     inputs.forEach(input => input.addEventListener('oninput', () => {
        //         console.log(input.value);
        //         //validateInput(input);
                
        //     }));
        //     let selects = form.querySelectorAll('select');
        //     selects.forEach(select => select.addEventListener('oninput', () => {
        //         validateInput(select);
        //     }));
        // })

        // // Loop over them and prevent submission
        
        // })()


        function validateForm() {
        // This function deals with validation of the form fields
        // Essa validação aqui que pode melhorar um pouquinho, juntando a validação default sugerida pelo Bootstrap
        let valid = true;
        currentInputs = tabs[currentTab].querySelectorAll("input");
        currentSelects = tabs[currentTab].querySelectorAll("select");
        //foreach input, checkvalidity() against constraints e aí se algum for invalido, seta como invalido
        currentInputs.forEach((input) => {
            if (! is_valid(input)) {
                input.classList.add('is-invalid');
                valid = false;
            }
        })
        currentSelects.forEach((select) => {
            if (!is_valid(select)) {
                select.classList.add('is-invalid');
                valid = false;
            }
        })
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            let step = document.getElementsByClassName("step")[currentTab];
            console.log("Bolinha do Step:");
            console.log(step);
            step.className += " finish";
        }
        return valid; // return the valid status
        }


        function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
        }


        // Toggle Password Visibility

        const seePassword = document.querySelector('#see_password');
        const seePasswordConfirm = document.querySelector('#see_password_confirm');

        seePassword.addEventListener('click', () => {
            toggleVisibility('#password');
            toggleIcon(seePassword);
        });

        seePasswordConfirm.addEventListener('click', () => {
            toggleVisibility('#password_confirmation');
            toggleIcon(seePasswordConfirm);
        });

        function toggleIcon(icon) {
            if (icon.classList.contains('bi-eye')) {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
            else {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        function toggleVisibility(inputId) {
            let input = document.querySelector(inputId);
            if (input.getAttribute('type') === 'password') {
                input.setAttribute('type', 'text');
                return;
            }
            input.setAttribute('type', 'password');
        }

        // Mostrar o campo de nome social
        const nomeSocialCheck = document.querySelector('#has_social_name');
        const nomeSocial = document.querySelector('#nome_social');
        const inputsNomeSocial = document.querySelectorAll('#nome_social input');
        nomeSocialCheck.addEventListener('change', () => {
            nomeSocial.classList.toggle('d-none');
            if (nomeSocial.classList.contains('d-none')) {
                inputsNomeSocial.forEach((input) => {
                    input.required = false;
                    input.value = '';
                }
            )
            } else {
                inputsNomeSocial.forEach((input) => {
                    input.required = true;
                    if (input.value === '') {
                        nextBtn.disabled = true};
                    }
                )
            }
        });

        // Validar se senhas estão batendo!

        // Validar conforme digita
        // Precisa pegar todos os input texts
        // e colocar um listener ao value change
        // e aí aplicar a validação de cada campo
        
        // const input_texts = document.querySelectorAll("input[type='text']");

        // input_texts.forEach((input) => {
        //     input.addEventListener('change', () => {validate_input(input)});
        // });

        // function validate_input(input) {
        //     let error_element = document.querySelector('#'+input.id + '+ .error');
        //     console.log(error_element);
        //     console.log("validando"+input.id);
        //     console.log(input.checkValidity());
        //     if(!input.checkValidity()) {
        //         error_element.classList.remove('invalid-feedback');
        //         input.setCustomValidity('Valor inválido');
        //     }
        //     else {
        //         error_element.classList.add('invalid-feedback');
        //         console.log("valid " + error_element);
        //     }
        // }

        // script Valida CPF:
        // https://www.geradorcpf.com/javascript-validar-cpf.htm

        // Para saber mais como funciona a regra de validação do CPF: 
        // https://www.macoratti.net/alg_cpf.htm 




    </script>

</x-guest-layout>
