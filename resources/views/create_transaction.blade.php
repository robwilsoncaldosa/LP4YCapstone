<!-- Create Transaction Modal -->
<div class="modal fade" id="createTransactionModal" tabindex="-1" aria-labelledby="createTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTransactionModalLabel">Create New Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your transaction creation form goes here -->
                <form action="{{ route('dashboard.transactions.storeTransaction') }}" method="post">
                    @csrf

                    <!-- Add your form fields for creating a new transaction -->
                    <div class="mb-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name..." required>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email..." required>
                    </div>

                    <div class="mb-3">
                        <label for="room_id">Room:</label>
                        <select class="form-control" id="room_id" name="room_id" required>
                            @foreach($roomNames as $roomId => $roomName)
                                <option value="{{ $roomId }}">{{ $roomName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="0" placeholder="Enter amount..." required>
                    </div>

                    <div class="mb-3">
                        <label for="payment_method">Payment Method:</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="cash">Cash</option>
                            <option value="credit_card">Credit Card</option>
                            <!-- Add other payment methods as needed -->
                        </select>
                    </div>

                    <!-- Add other fields as needed -->

                    <button type="submit" class="btn btn-primary">Create Transaction</button>
                </form>
            </div>
        </div>
    </div>
</div>
