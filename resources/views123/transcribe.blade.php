@extends('layouts.app')
@section('section')
@push('styles')
<style>
        .highlight {
            background-color: yellow;
        }
		 .audio-container {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .audio-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 5px;
        }
        .audio-container audio {
            flex: 1;
        }
    </style>
@endpush
    

    @if (session('message'))
        <div>{{ session('message') }}</div>
    @endif
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to Upload Audio File -->
    <form action="{{ route('upload.audio') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="audio_file">Upload Audio File:</label>
            <input type="file" name="audio_file" id="audio_file" required>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
    </form>

    <!-- Form to Start Transcription -->
    <form action="{{ route('transcribe.audio') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success mt-2">Start Transcription</button>
    </form>

    <!-- Button to Check Transcription Status -->
    @if ($transcription = App\Models\Transcription::latest()->first())
        <form action="{{ route('transcription.status', $transcription->id) }}" method="GET">
            <button type="submit" class="btn btn-success mt-2">Check Transcription Status</button>
        </form>
        @if ($transcription->transcription_text)
			<h3 class="m-2">Suumary</h3>
		<p>{{ $transcription->summary }}</p>
		<!--<td><p>{{ $transcription->transcription_text }}</p></td>-->
				<!--<td><p>{{ $transcription->json }}</p></td>-->
				<!--<td><p>{{ $transcription->results }}</p></td>-->
				<!--<td><p>{{ $transcription->transcript }}</p></td>-->
            <div>
                <h3 class="m-2">Transcription Result:</h3>
                <div style="display: flex;">
                    <!-- Display the transcription text -->
                    <div style="flex: 1;">
                        <div id="transcriptionText">
                            @php
                                $khan = $transcription->json;
                                $data = json_decode($khan, true);
                                $items = $data['results']['items'];
                            @endphp

                            @foreach ($items as $item)
                                @if (isset($item['start_time']) && isset($item['end_time']))
                                    <span data-start="{{ $item['start_time'] }}" data-end="{{ $item['end_time'] }}">
                                        {{ $item['alternatives'][0]['content'] }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Audio Player -->
                    <div style="flex: 1;">
                       <div class="audio-container">
    <img src="{{ asset('img/favicon.png') }}" alt="Audio Image">
    <audio id="audioPlayer" controls>
        <source src="{{ asset('shoaib.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
</div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    
@push('scripts')
<script>
        // JavaScript to synchronize the transcription text with audio playback
        const audioPlayer = document.getElementById('audioPlayer');
        const transcriptionText = document.getElementById('transcriptionText');
        const items = @json($items);

        audioPlayer.addEventListener('timeupdate', () => {
            const currentTime = audioPlayer.currentTime;

            items.forEach(item => {
                if (item.start_time && item.end_time) {
                    const startTime = parseFloat(item.start_time);
                    const endTime = parseFloat(item.end_time);

                    const span = transcriptionText.querySelector(`[data-start="${startTime}"]`);
                    if (span) {
                        if (currentTime >= startTime && currentTime <= endTime) {
                            span.classList.add('highlight');
                        } else {
                            span.classList.remove('highlight');
                        }
                    }
                }
            });
        });
    </script>

@endpush
@endsection
