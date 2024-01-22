@if (Auth::user()->last_name == 'Latinfarma')
    <footer class="footer text-center">
        Latinfarma Droguería <i data-feather="heart" class="feather-icon"></i>
    </footer>
@else
    <footer class="footer text-center">
        JL Pharma Medicamentos <i data-feather="heart" class="feather-icon"></i>
    </footer>
@endif
