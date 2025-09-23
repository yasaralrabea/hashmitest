@php
  $lastDate = null;
@endphp

@foreach($messages->reverse() as $msg)
  @php
    $date = $msg->created_at->format('Y-m-d');
  @endphp

  {{-- فاصل التاريخ --}}
  @if($lastDate !== $date)
    <div class="date-separator">{{ $msg->created_at->format('d M Y') }}</div>
    @php $lastDate = $date; @endphp
  @endif

  <div class="chat-message 
              {{ $msg->user_id == auth()->id() ? 'user' : 'other' }}
              {{ $msg->user->is_admin ? 'admin' : '' }}"
       data-id="{{ $msg->id }}">

    <div class="message-body">{{ $msg->message }}</div>
    <div class="message-time">{{ $msg->created_at->format('H:i') }}</div>

    @if($msg->user_id == auth()->id() || auth()->user()->is_admin)
      <div class="message-actions">
        <span class="edit">✎ تعديل</span>
        <span class="delete">🗑 حذف</span>
      </div>
    @endif
  </div>
@endforeach
