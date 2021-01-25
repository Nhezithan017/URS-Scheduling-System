<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" media="all" />
<link rel="stylesheet" href="{{ asset('css/print.css') }}" media="all" />

<div class="row">
  <div class="col text-center mb-2">
    <h1 class="">UNIVERSITY OF RIZAL SYSTEM</h1>
    <h1 class="text-sm">MORONG, CAMPUS</h1>
  </div>
</div>
<div class="row">
  <div class="col text-center mb-2">
    <h1 class="">COLLEGE OF ENGINEERING</h1>

  </div>
</div>

<div class="row mt-0">
  <div class="col text-center mb-4">
    <h1 class="">1ST YEAR - 5TH YEAR</h1>
    <h1 class="">SCHEDULE OF CLASS</h1>
    <h1 class="text-uppercase">{{ $course->semester }}, SY {{ $course->sy_start }} - {{ $course->sy_end }}</h1>
  </div>
</div>

@foreach($course->sections as $sec)
@if($sec->allocate_classroom()->count() > 0)
<div class="row mb-4 container-fluid">
<table width="1000px">
  <thead>
    <tr>
      <th scope="col" colspan="3">SECTION: {{ $sec->description }} {{ $sec->section }}</th>
      <th scope="col" colspan="4">ADVISER: {{ $sec->adviser }}</th>
      <th scope="col" colspan="4">ROOM ASSIGNMENT</th>
    </tr>
    <tr>

      <th scope="col">DAYS</th>
      <th scope="col">TIME</th>
      <th scope="col">COURSE CODE</th>
      <th scope="col">DESCRIPTIVE TITLE</th>
      <th scope="col">LECTURE</th>
      <th scope="col">LAB/FIELD</th>
      <th scope="col">UNIT</th>
      <th scope="col">ROOM</th>
      <th scope="col">YR & SEC</th>
      <th scope="col" colspan="2">INSTRUCTOR</th>
    </tr>
  </thead>
  <tbody>
  
    @foreach($sec->allocate_classroom as $all_cm)
    <tr align="center">
      <td>
        {{ implode('-',$all_cm->days) }}
      </td> 
      <td width="80px">{{ Carbon\Carbon::parse($all_cm->start_time)->format('h:i') }} - {{ Carbon\Carbon::parse($all_cm->end_time)->format('h:i') }}</td>
     
      {{ $subject = App\Subject::find($all_cm->subject_id) }}
      <td>{{ $subject->code }}</td>
      <td>{{ $subject->description }}</td>
      <td class="td-center">{{ $subject->lec  }}</td>
      <td class="td-center">{{ $subject->lab }}</td>
      <td class="td-center">{{ $subject->unit }}</td>

      <td class="td-center">{{ $all_cm->room_no }}</td>
      {{ $section = App\Section::find($all_cm->section_id) }}
      <td class="td-center">{{ $all_cm->year }}-{{ $all_cm->section }}</td>
      {{ $teacher = App\Teacher::find($all_cm->teacher_id) }}
      <td class="td-center">{{ $teacher->name }}</td>
      <td class="td-center">{{ $all_cm->status === 1 ? 'ok' : 'not' }}</td>
    </tr>


    @endforeach
    <tr align="center">
      <td></td>
      <td></td>
      <td></td>
 
      {{$lec = DB::table('allocate_classrooms')->where('section_id', '=', $all_cm->section_id)->sum('lec') }}
      {{$lab = DB::table('allocate_classrooms')->where('section_id', '=', $all_cm->section_id)->sum('lab') }}
      {{$unit = DB::table('allocate_classrooms')->where('section_id', '=', $all_cm->section_id)->sum('unit') }}
  
      <td align="center">Total</td>
      <td align="center"> {{ $lec }}</td>
      <td align="center">{{ $lab }}</td>
      <td align="center">{{ $unit }}</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

    </tr>
  </tbody>
</table>


</div>
@endif
@endforeach

<script type="text/php">
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
</script> 