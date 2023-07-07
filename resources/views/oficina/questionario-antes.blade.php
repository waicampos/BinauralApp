<x-app-layout>

    <form action="{{ route('questionario_previo') }}" method="post">
        @csrf
        <fieldset class="my-3">
            <legend>Como você está se sentindo hoje?</legend>

            <div>
                <input type="hidden" name="question" value="Como você está se sentindo hoje?">
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="1" value="1-Bem e com disposição" required>
                <label for="1" class="form-check-label">Bem e com disposição</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="2" value="2-Ansioso">
                <label for="2" class="form-check-label">Ansioso</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="3" value="3-Depressivo" required>
                <label for="3" class="form-check-label">Depressivo</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="4" value="4-Dificuldade para relaxar ou dormir" required>
                <label for="4" class="form-check-label">Dificuldade para relaxar ou dormir</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="5" value="5-Desatento e sem foco" required>
                <label for="5" class="form-check-label">Desatento e sem foco</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="6" value="6-Dificuldade para resolver problemas ou estudo" required>
                <label for="6" class="form-check-label">Dificuldade para resolver problemas ou estudo</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="sentimento" id="7" value="7-Outro" required>
                <label for="7" class="form-check-label">Outro: </label>
                <input type="text" class="" name="sentimento" id="7" value="" placeholder="" disabled>
            </div>

        </fieldset>

        <button type="submit" class="btn btn-primary">Iniciar Player</button>

    </form>

</x-app-layout>