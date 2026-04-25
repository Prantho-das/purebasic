@extends('layouts.register')
@section('content')
    <div class="profileContainer">
        <div class="row batchCategories">
            
            <div class="col-3">&nbsp</div>
                
            <div class="col-6">
            
                    
                <a href="/batches/category/1" class="batchCategory"><h3>Medicine</h3></a>
                
                <a href="/batches/category/2" class="batchCategory" style="margin-right:2%; margin-left:2%;"><h3>Dentistry</h3></a>
                
                <a href="/batches/category/3" class="batchCategory"><h3>BCS</h3></a>
                
            </div>
            
            <div class="col-3">&nbsp</div>
            
        </div>


        @if (empty($courses))
    
            <div class="row">
            
                <div class="col-4">&nbsp</div>
                
                    <div class="col-4 alert">
                        
                        <div class="centerText">
                            <h3>No Enrollment</h3>
                            <p>You have not enrolled in any program. Meanwhile you can enjoy free lectures and free exams</p>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-4 centerText contentLink">
                                <a href="/student/free_lecture"><h3>Free Lectures</h3></a>
    
                            </div>
                            
                            <div class="col-4">&nbsp</div>
                            
                            <div class="col-4 centerText contentLink">
                                <a href="/student/free_exam"><h3>Free Exams</h3></a>
                            </div>
                            
                        </div>
                    
                    </div>
                        
                <div class="col-4">&nbsp</div>
            </div>
    
        @endif
    
            
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4">
                
                @foreach($courses as $sub_course)
            
                    
                    @foreach($sub_course as $course)
                    
                        @if (!empty($course->course))
                        
                            <div class="enrolledProgram">
                  
                                <h2 class="batchTitle">{{$course->course->plan}}</h2>
            
                            
                                <h5>For {{$course->course->graduation}}</h5>
                                
                                <div class="marginBelow">
                                    
                                    @if ($course->enroll_status == 0)
                                        <h5>Approval Status : <span class="red">Pending</span></h5>
                                        <a class="verifyLink centerText" href="{{url('/payment/'.$course->batch_id)}}">Update Payment Info</a>

                                            
                                    @elseif ($course->enroll_status == 1)
                                        <h5>Approval Status : <span class = "green">Activated</span></h5>
                                    
                                        
                                        
                                    @else
                                        <h5>Approval Status : <span class="red">Deactivated/Rejected </span></h5>
                                    @endif
      
    
                                    
                                </div>
                                
                                <div>Fees : {{$course->fees}}<span style="float:right">Paid : {{$course->paid}}</span></div>

    
                                @if($course->enroll_status==1)
                                
                                    @php
                                        $endStr = substr($course->subscription_end,0,10);
                                        
                                        $endNum = (int) $endStr;
                                        
                                        $end = new DateTime($endStr);
    
                                        $current = new DateTime(date("Y-m-d"));
    
    
                                        $remaining = $end->diff($current)->format('%a');;
                                    
                                    @endphp
                                
                                    <div>Subscription End : {{$endStr}}</div>

                                    
                                    <div>
                                        Subscription remaining : <span class= {{(int)$remaining <= 15 ? "red" : "green"}}>{{$remaining}} Days</span> 
                                    </div>

                                    @if ($endNum > 0)
                                        <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                            <a class="centerText lectureLink linkCategory" href="{{url('batch/'.$course->batch_id.'/subjects')}}">Lecture</a>

                                            <a class="centerText examLink linkCategory" href="{{url('exam_by_batch',$course->batch_id)}}">Exam</a>
                                    
                                            <a class="centerText scheduleLink linkCategory" href="{{url('schedule/batch/'.$course->batch_id)}}">Schedule</a>
                                            
                                        </div>

                                        <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                                                                   <a class="centerText discussionLink linkCategory" href="{{url('discussion/batch/'.$course->batch_id)}}">Discussion</a>
                                        
                                        </div>
                                        
                                        <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                                                                   <a class="centerText liveLink linkCategory" href="{{url('live/'.$course->batch_id)}}">Live Class</a>
                                        
                                        </div>

                                    @endif
                                    
                                    
                                    
                                    
                                @elseif ($course->enroll_status == 0)
                                    <h5 class="red">Please wait 24 hours for approval</h5>                                
                                @else
                                    <h5 class="red">Please whatsapp us</h5>
                                @endif
                                
                            </div>
                		  
                        @endif
              
        		    @endforeach
        		    
                @endforeach
    
            </div>
            
            <div class="col-4">&nbsp</div>
            
          </div>
    </div>

    {{-- ════════════════════════════════════════════════════════
         ANALYTICS DASHBOARD
    ════════════════════════════════════════════════════════ --}}
    <div class="analytics-wrap">
        <h2 class="analytics-heading">
            <i class="fa-regular fa-chart-mixed"></i> My Learning Analytics
        </h2>

        {{-- ── Lecture Progress ───────────────────────────────── --}}
        @if(!empty($lectureAnalytics))
        <div class="analytics-section">
            <h4 class="analytics-section-title">
                <i class="fa-regular fa-play-circle"></i> Lecture Progress
            </h4>
            <div class="analytics-cards">
                @foreach($lectureAnalytics as $stat)
                <div class="analytics-card">
                    <div class="analytics-card-header">
                        <span class="analytics-card-title">{{ $stat['title'] }}</span>
                        <span class="analytics-badge {{ $stat['pct'] >= 80 ? 'badge-green' : ($stat['pct'] >= 40 ? 'badge-yellow' : 'badge-gray') }}">
                            {{ $stat['pct'] }}%
                        </span>
                    </div>
                    <div class="analytics-progress-bar">
                        <div class="analytics-progress-fill {{ $stat['pct'] >= 80 ? 'fill-green' : ($stat['pct'] >= 40 ? 'fill-yellow' : 'fill-blue') }}"
                             style="width: {{ $stat['pct'] }}%"></div>
                    </div>
                    <div class="analytics-progress-meta">
                        <span><i class="fa-regular fa-check-circle"></i> Watched: <strong>{{ $stat['watched'] }}</strong></span>
                        <span><i class="fa-regular fa-film"></i> Total: <strong>{{ $stat['total'] }}</strong></span>
                        <span><i class="fa-regular fa-hourglass-half"></i> Remaining: <strong>{{ $stat['total'] - $stat['watched'] }}</strong></span>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Lecture bar chart --}}
            @if(count($lectureAnalytics) > 0)
            <div class="chart-box">
                <h5 class="chart-title">Lectures Watched vs Total (per Course)</h5>
                <canvas id="lectureBarChart" height="120"></canvas>
            </div>
            @endif
        </div>
        @endif

        {{-- ── Exam Analytics ─────────────────────────────────── --}}
        <div class="analytics-section">
            <h4 class="analytics-section-title">
                <i class="fa-regular fa-file-pen"></i> Exam Performance
            </h4>

            {{-- Stat cards row --}}
            <div class="stat-cards">
                <div class="stat-card">
                    <div class="stat-icon stat-blue"><i class="fa-regular fa-list-check"></i></div>
                    <div class="stat-body">
                        <div class="stat-value">{{ $examAnalytics['attempted'] }}</div>
                        <div class="stat-label">Exams Taken</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-green"><i class="fa-regular fa-circle-check"></i></div>
                    <div class="stat-body">
                        <div class="stat-value">{{ $examAnalytics['totalCorrect'] }}</div>
                        <div class="stat-label">Correct Answers</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-red"><i class="fa-regular fa-circle-xmark"></i></div>
                    <div class="stat-body">
                        <div class="stat-value">{{ $examAnalytics['totalWrong'] }}</div>
                        <div class="stat-label">Wrong Answers</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-yellow"><i class="fa-regular fa-gauge-high"></i></div>
                    <div class="stat-body">
                        <div class="stat-value">{{ $examAnalytics['avgScore'] }}%</div>
                        <div class="stat-label">Avg Score</div>
                    </div>
                </div>
            </div>

            @if($examAnalytics['attempted'] > 0)
            <div class="charts-row">
                {{-- Pie chart --}}
                <div class="chart-box chart-box-sm">
                    <h5 class="chart-title">Answer Breakdown</h5>
                    <canvas id="examPieChart"></canvas>
                </div>

                {{-- Bar chart --}}
                <div class="chart-box chart-box-lg">
                    <h5 class="chart-title">Score % per Exam (last 10)</h5>
                    <canvas id="examBarChart" height="120"></canvas>
                </div>
            </div>
            @else
                <p class="no-data-msg">No exam attempts yet. Take an exam to see your analytics here.</p>
            @endif
        </div>
    </div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<style>
/* ── Analytics wrapper ───────────────────────── */
.analytics-wrap {
    max-width: 960px;
    margin: 40px auto 60px;
    padding: 0 20px;
    font-family: "Poppins", sans-serif;
}
.analytics-heading {
    font-size: 22px; font-weight: 700; color: #1a202c;
    margin-bottom: 28px;
    display: flex; align-items: center; gap: 10px;
}
.analytics-heading i { color: #4f46e5; }

/* ── Sections ────────────────────────────────── */
.analytics-section {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 24px;
    margin-bottom: 28px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.analytics-section-title {
    font-size: 15px; font-weight: 700; color: #374151;
    margin: 0 0 18px;
    display: flex; align-items: center; gap: 8px;
}
.analytics-section-title i { color: #6366f1; }

/* ── Lecture cards ───────────────────────────── */
.analytics-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 14px;
    margin-bottom: 20px;
}
.analytics-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 14px 16px;
}
.analytics-card-header {
    display: flex; align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}
.analytics-card-title {
    font-size: 13px; font-weight: 600; color: #1e293b;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    max-width: 180px;
}
.analytics-badge {
    font-size: 11px; font-weight: 700; padding: 2px 8px;
    border-radius: 20px;
}
.badge-green  { background: #dcfce7; color: #15803d; }
.badge-yellow { background: #fef9c3; color: #a16207; }
.badge-gray   { background: #f1f5f9; color: #64748b; }

/* Progress bar */
.analytics-progress-bar {
    height: 8px; background: #e2e8f0; border-radius: 99px; overflow: hidden;
    margin-bottom: 8px;
}
.analytics-progress-fill { height: 100%; border-radius: 99px; transition: width 0.6s ease; }
.fill-green  { background: #22c55e; }
.fill-yellow { background: #eab308; }
.fill-blue   { background: #6366f1; }

.analytics-progress-meta {
    display: flex; gap: 12px; flex-wrap: wrap;
    font-size: 11px; color: #64748b;
}
.analytics-progress-meta i { color: #94a3b8; margin-right: 2px; }

/* ── Stat cards ──────────────────────────────── */
.stat-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 14px;
    margin-bottom: 24px;
}
.stat-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 14px 16px;
    display: flex; align-items: center; gap: 12px;
}
.stat-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; flex-shrink: 0;
}
.stat-blue   { background: #eff6ff; color: #3b82f6; }
.stat-green  { background: #f0fdf4; color: #22c55e; }
.stat-red    { background: #fef2f2; color: #ef4444; }
.stat-yellow { background: #fffbeb; color: #f59e0b; }
.stat-value  { font-size: 22px; font-weight: 800; color: #1e293b; line-height: 1.1; }
.stat-label  { font-size: 11px; color: #64748b; font-weight: 500; margin-top: 2px; }

/* ── Charts ──────────────────────────────────── */
.charts-row {
    display: flex; gap: 20px; flex-wrap: wrap;
}
.chart-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px;
    flex: 1; min-width: 220px;
}
.chart-box-sm { max-width: 260px; }
.chart-box-lg { flex: 2; }
.chart-title {
    font-size: 12px; font-weight: 700; color: #475569;
    text-transform: uppercase; letter-spacing: 0.4px;
    margin: 0 0 12px;
}
.no-data-msg {
    text-align: center; color: #94a3b8; font-size: 14px; padding: 30px 0;
}
</style>
<script>
(function () {

    // ── Lecture bar chart ─────────────────────────────────
    @if(!empty($lectureAnalytics))
    const lectureCtx = document.getElementById('lectureBarChart');
    if (lectureCtx) {
        new Chart(lectureCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_column($lectureAnalytics, 'title')) !!},
                datasets: [
                    {
                        label: 'Watched',
                        data: {!! json_encode(array_column($lectureAnalytics, 'watched')) !!},
                        backgroundColor: '#6366f1',
                        borderRadius: 6,
                    },
                    {
                        label: 'Total',
                        data: {!! json_encode(array_column($lectureAnalytics, 'total')) !!},
                        backgroundColor: '#e2e8f0',
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });
    }
    @endif

    // ── Exam charts ───────────────────────────────────────
    @if($examAnalytics['attempted'] > 0)

    // Pie chart — correct / wrong / unanswered
    new Chart(document.getElementById('examPieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Correct', 'Wrong', 'Unanswered'],
            datasets: [{
                data: [
                    {{ $examAnalytics['totalCorrect'] }},
                    {{ $examAnalytics['totalWrong'] }},
                    {{ $examAnalytics['totalUnanswered'] }},
                ],
                backgroundColor: ['#22c55e', '#ef4444', '#94a3b8'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            cutout: '65%',
            plugins: {
                legend: { position: 'bottom', labels: { font: { size: 11 } } }
            }
        }
    });

    // Bar chart — score % per exam
    const perExam = {!! json_encode($examAnalytics['perExam']) !!};
    new Chart(document.getElementById('examBarChart'), {
        type: 'bar',
        data: {
            labels: perExam.map(e => e.name.length > 22 ? e.name.slice(0, 22) + '…' : e.name),
            datasets: [{
                label: 'Score %',
                data: perExam.map(e => e.score),
                backgroundColor: perExam.map(e =>
                    e.score >= 70 ? '#22c55e' : e.score >= 40 ? '#f59e0b' : '#ef4444'
                ),
                borderRadius: 5,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    min: 0, max: 100,
                    ticks: { callback: v => v + '%' }
                },
                x: { ticks: { font: { size: 10 } } }
            }
        }
    });

    @endif
})();
</script>
