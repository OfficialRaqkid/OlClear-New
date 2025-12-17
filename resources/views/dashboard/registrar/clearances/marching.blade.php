<x-master-layout
    :breadcrumbs="['Registrar', 'Marching Clearances']"
    sidebar="dashboard.registrar.partials.sidebar"
    navbar="dashboard.registrar.partials.navbar">

    <h2>Marching Clearances</h2>

    @if ($clearances->isEmpty())
        <p>No published marching clearances.</p>
    @else
        <table class="table">
            @foreach ($clearances as $clearance)
                <tr>
                    <td>{{ $clearance->title }}</td>
                    <td>
                        <a href="{{ route('registrar.marching.requests', $clearance) }}"
                           class="btn btn-primary btn-sm">
                            View Requests
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

</x-master-layout>
