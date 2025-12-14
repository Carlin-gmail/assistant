<x-app-layout>

 <button id="feedbackToggle">Feedback</button>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#testModal">
        Open modal
    </button>

    <div class="modal fade" id="testModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Test</h5>
        </div>
        <div class="modal-body">
            Bootstrap JS works 🎉
        </div>
        </div>
    </div>
    </div>
    <div style="border: 5px solid red; padding: 20px;">
        CSS test
    </div>
    <hr>
    <button class="btn btn-danger">Bootstrap Button</button>
</x-app-layout>
