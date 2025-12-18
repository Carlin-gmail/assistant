<x-layouts.app title="User Feedback">

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Feedback Inbox</h1>

        <span class="badge bg-secondary">
            Hardcoded Preview
        </span>
    </div>

    <p class="text-muted mb-4">
        This page lists feedback sent by users.
        Each item must be reviewed and checked once resolved.
    </p>

    {{-- FEEDBACK LIST --}}
    <div class="card">
        <div class="card-header">
            Pending Feedback
        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0 align-middle">

                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">✔</th>
                        <th>User</th>
                        <th>Message</th>
                        <th>Page</th>
                        <th>Status</th>
                        <th style="width: 120px;">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- FEEDBACK ITEM 1 --}}
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" disabled>
                        </td>

                        <td>
                            <strong>John Doe</strong><br>
                            <small class="text-muted">john@email.com</small>
                        </td>

                        <td>
                            The leftovers page is confusing when multiple bags have the same number.
                        </td>

                        <td>
                            <a href="#" class="text-decoration-none">
                                /leftovers
                            </a>
                        </td>

                        <td>
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        </td>

                        <td>
                            <button class="btn btn-sm btn-outline-success" disabled>
                                Mark Done
                            </button>
                        </td>
                    </tr>

                    {{-- FEEDBACK ITEM 2 --}}
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" checked disabled>
                        </td>

                        <td>
                            <strong>Maria Silva</strong><br>
                            <small class="text-muted">maria@email.com</small>
                        </td>

                        <td>
                            It would be great to upload images directly when creating leftovers.
                        </td>

                        <td>
                            <a href="#" class="text-decoration-none">
                                /bags/12
                            </a>
                        </td>

                        <td>
                            <span class="badge bg-success">
                                Done
                            </span>
                        </td>

                        <td>
                            <button class="btn btn-sm btn-outline-secondary" disabled>
                                Archived
                            </button>
                        </td>
                    </tr>

                    {{-- FEEDBACK ITEM 3 --}}
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" disabled>
                        </td>

                        <td>
                            <strong>Alex Brown</strong><br>
                            <small class="text-muted">alex@email.com</small>
                        </td>

                        <td>
                            The bag identifier should be clearer. I don’t know what 1012.3 means.
                        </td>

                        <td>
                            <a href="#" class="text-decoration-none">
                                /bags
                            </a>
                        </td>

                        <td>
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        </td>

                        <td>
                            <button class="btn btn-sm btn-outline-success" disabled>
                                Mark Done
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>
    </div>

</div>

</x-layouts.app>
