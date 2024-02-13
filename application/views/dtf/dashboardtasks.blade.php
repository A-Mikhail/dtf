@layout('layout')

@section('csstop')
<link rel='stylesheet' href='/libs/select2/select2.min.css'>
@endsection

@section('content')
<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Статистика за сегодня</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div
                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#collection" />
                </svg>
            </div>
            <h3 class="fs-2 text-body-emphasis">Featured title</h3>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and
                probably just keep going until we run out of words.</p>
            <a href="#" class="icon-link">
                Call to action
                <svg class="bi">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
        <div class="feature col">
            <div
                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#people-circle" />
                </svg>
            </div>
            <h3 class="fs-2 text-body-emphasis">Featured title</h3>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and
                probably just keep going until we run out of words.</p>
            <a href="#" class="icon-link">
                Call to action
                <svg class="bi">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
        <div class="feature col">
            <div
                class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                <svg class="bi" width="1em" height="1em">
                    <use xlink:href="#toggles2" />
                </svg>
            </div>
            <h3 class="fs-2 text-body-emphasis">Featured title</h3>
            <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and
                probably just keep going until we run out of words.</p>
            <a href="#" class="icon-link">
                Call to action
                <svg class="bi">
                    <use xlink:href="#chevron-right" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Статистика за период -->
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
            <th>Name</th>
            <th>Title</th>
            <th>Status</th>
            <th>Position</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                        class="rounded-circle" />
                    <div class="ms-3">
                        <p class="fw-bold mb-1">John Doe</p>
                        <p class="text-muted mb-0">john.doe@gmail.com</p>
                    </div>
                </div>
            </td>
            <td>
                <p class="fw-normal mb-1">Software engineer</p>
                <p class="text-muted mb-0">IT department</p>
            </td>
            <td>
                <span class="badge badge-success rounded-pill d-inline">Active</span>
            </td>
            <td>Senior</td>
            <td>
                <button type="button" class="btn btn-link btn-sm btn-rounded">
                    Edit
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <img src="https://mdbootstrap.com/img/new/avatars/6.jpg" class="rounded-circle" alt=""
                        style="width: 45px; height: 45px" />
                    <div class="ms-3">
                        <p class="fw-bold mb-1">Alex Ray</p>
                        <p class="text-muted mb-0">alex.ray@gmail.com</p>
                    </div>
                </div>
            </td>
            <td>
                <p class="fw-normal mb-1">Consultant</p>
                <p class="text-muted mb-0">Finance</p>
            </td>
            <td>
                <span class="badge badge-primary rounded-pill d-inline">Onboarding</span>
            </td>
            <td>Junior</td>
            <td>
                <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                    Edit
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <img src="https://mdbootstrap.com/img/new/avatars/7.jpg" class="rounded-circle" alt=""
                        style="width: 45px; height: 45px" />
                    <div class="ms-3">
                        <p class="fw-bold mb-1">Kate Hunington</p>
                        <p class="text-muted mb-0">kate.hunington@gmail.com</p>
                    </div>
                </div>
            </td>
            <td>
                <p class="fw-normal mb-1">Designer</p>
                <p class="text-muted mb-0">UI/UX</p>
            </td>
            <td>
                <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
            </td>
            <td>Senior</td>
            <td>
                <button type="button" class="btn btn-link btn-rounded btn-sm fw-bold" data-mdb-ripple-color="dark">
                    Edit
                </button>
            </td>
        </tr>
    </tbody>
</table>
@endsection

@section('js')
<script src="/libs/select2/select2.min.js"></script>

<script>
    $('#reporting_date').on('select2:select', function (e) {
        var data = e.params.data;

        location.replace("?reporting_date=" + data.id);
    });
</script>
@endsection