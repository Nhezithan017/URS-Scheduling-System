<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" media="all" />
<link rel="stylesheet" href="{{ asset('css/print.css') }}" media="all" />

<div class="row">
  <div class="col text-center mb-2">
    <h1 class="">COLLEGE OF ENGINEERING</h1>
  </div>
</div>
<div class="row">
  <div class="col text-center mb-2">
    <h1 class="">ROOM UTILIZATION</h1>
    <h1 class="text-uppercase">{{ $course->semester }}, SY {{ $course->sy_start }} - {{ $course->sy_end }}</h1>
  </div>
</div>




<div class="row mb-4 container mx-4">
<table>
  <thead>
    <tr>
      <th scope="col">Time Interval</th>
      <th scope="col">Time</th>
      <th scope="col">Days</th>
      <th scope="col">Instructor</th>
      <th scope="col">Subject Code</th>
      <th scope="col">Year & Section</th>
      <th scope="col">Room No.</th>
    </tr>
  </thead>
  @foreach($course->sections as $sec) 
  <tbody>
{{ $allocate_classroom =  App\AllocateClassroom::where('section_id', $sec->id)->orderBy('days','asc')->orderBy('start_time','asc')->get() }}
 @foreach($allocate_classroom as $all_cr)

  {{ $endTime = Carbon\Carbon::parse($all_cr->end_time) }}
  {{ $startTime = Carbon\Carbon::parse($all_cr->start_time) }}
  {{ $totalDuration =  $startTime->diff($endTime)->format('%H:%I') }}
 <tr>
 <td>{{ $totalDuration }}</td>
 <td>{{ Carbon\Carbon::parse($all_cr->start_time)->format('h:i a') }} - {{ Carbon\Carbon::parse($all_cr->end_time)->format('h:i a') }}</td>
 <td>{{ implode('-', $all_cr->days) }}</td>
 {{ $teacher = App\Teacher::find($all_cr->teacher_id)}}
 {{ $subject = App\Subject::find($all_cr->subject_id) }}
 <td>{{ $teacher->name }}</td>
 <td> {{ $subject->code }}</td>
 <td> {{ $all_cr->year }} - {{ $all_cr->section }}</td>
 <td>{{ $all_cr->room_no}}</td>
 @endforeach
  </tbody>
  @endforeach
</table>


</div>



<script type="text/php">
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
</script> 