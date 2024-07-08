@extends('admin.layout.master')

@section('title', 'View Ticket')
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ticket Details</h1>
        </div>

        <div class="row mb-2">
            <div class="col-12 col-md-2 text-xs font-weight-bold text-uppercase">Customer</div>
            <div class="col-12 col-md-3 text-xs font-weight-bold text-uppercase">Subject</div>
            <div class="col-6 col-md-1 text-xs font-weight-bold text-uppercase">Status</div>
            <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Assigned To</div>
            <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Date Posted</div>
            <div class="col-12 col-md-2 text-xs font-weight-bold text-uppercase text-md-center">Action</div>
        </div>

        <div
            class="card shadow mb-2 
            @if (strtolower($ticket->status) == 'pending') border-left-warning
            @elseif(strtolower($ticket->status) == 'ongoing') border-left-success
            @elseif(strtolower($ticket->status) == 'completed') border-left-primary
            @elseif(strtolower($ticket->status) == 'cancelled') border-left-danger @endif">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">Customer: </strong>{{ $ticket->customer_name ?? 'N/A' }}
                    </div>
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <strong class="d-md-none">Subject: </strong>{{ $ticket->subject }}
                    </div>
                    <div class="col-12 col-md-1 mb-3 mb-md-0">
                        <strong class="d-md-none">Status: </strong>{{ $ticket->status }}
                    </div>
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">Assigned to: </strong>{{ $ticket->technician_name ?? 'N/A' }}
                    </div>
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">Date Posted: </strong>{{ $ticket->created_at }}
                    </div>
                    <div class="col-12 col-md-2 text-md-center">
                        <strong class="d-md-none">Action: </strong>
                        <a href="{{ route('admin.ticket.edit_ticket', $ticket->id) }}"><i class="bi bi-pencil-square"
                                style="color:green"></i></a>
                        <a href="{{ route('admin.ticket.delete_ticket', $ticket->id) }}"><i class="bi bi-trash"
                                style="color:red"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h5 class="text-uppercase font-weight-bold mb-3">Ticket Message</h5>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text" style="text-align: justify; margin: 10px; padding: 5px;">{{ $ticket->message }}</p>
                    {{$ticket -> image}}
                    {{-- @if ($ticket->image)
                        <p class="card-text" style="text-align: justify; margin: 10px; padding: 5px;">
                            <img src="{{ $imageUrl }}" alt="Ticket Image" class="img-fluid">
                        </p>
                    @endif --}}
                </div>
            </div>

            @if ($messages->isNotEmpty())
                <h5 class="text-uppercase font-weight-bold mt-4 mb-3">Message Thread</h5>
                <div class="card mb-3">
                    <div class="card-body">
                        @foreach ($messages as $message)
                            <div class="mb-3">
                                <div class="text-{{ $message->sender_type == 'customer' ? 'start' : 'end' }}">
                                    {{ $message->sender_type == 'customer' ? $message->customer_name : $message->technician_name }}
                                    ({{ ucfirst($message->sender_type) }})
                                </div>
                                <div class="d-flex {{ $message->sender_type == 'customer' ? 'justify-content-start' : 'justify-content-end' }} mb-3">
                                    <div class="p-3 rounded {{ $message->sender_type == 'customer' ? 'bg-primary text-light' : 'bg-primary text-light' }}"
                                        style="max-width: 75%;">
                                        <p class="mb-1">{{ $message->message }}</p>
                                        {{$message->image}}
                                        {{-- @if ($message->image)
                                            <img src="{{ url('message_images/' . $message->image) }}" alt="Message Image"
                                                class="img-fluid">
                                        @endif --}}
                                        <small class="d-block text-end">{{ $message->created_at }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endif


            @if ($ticket->feedback_message || $ticket->feedback_rate)
                <h5 class="text-uppercase font-weight-bold mt-4 mb-3">Feedback Review</h5>
                <div class="card mb-3">
                    <div class="card-body">
                        @if ($ticket->feedback_message)
                            <p class="card-text" style="text-align: justify; margin: 10px; padding: 5px;">
                                {{ $ticket->feedback_message }}</p>
                        @endif
                        @if ($ticket->feedback_rate)
                            <div class="text-center">
                                <h5>Feedback Rate: {{ $ticket->feedback_rate }}/5</h5>
                                <div class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $ticket->feedback_rate)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            <a href="{{ route('admin.ticket') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
        </div>
    </div>
@endsection
