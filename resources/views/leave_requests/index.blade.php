<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests</title>
    <style>
        body { font-family: Arial, sans-serif; 
            max-width: 900px; 
            margin: 40px auto; 
            padding: 0 20px; 
            background: #f5f5f5; 
        }

        h1, h2 { color: #333; }

        .form-card { background: white; 
            padding: 24px; 
            border-radius: 8px; 
            margin-bottom: 32px; 
            box-shadow: 0 1px 4px rgba(0,0,0,0.1); }

        .form-group { margin-bottom: 16px; }

        label { display: block; 
            font-weight: bold; 
            margin-bottom: 4px; 
            color: #555; 
        }
        
        input, textarea { width: 100%; 
            padding: 8px 12px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            box-sizing: border-box; 
            font-size: 14px; 
        }

        .btn-submit { background: #3182ce; 
            color: white; padding: 10px 24px; 
            border: none; border-radius: 4px; 
            cursor: pointer; font-size: 15px; 
        }

        .btn-submit:hover { background: #2b6cb0; }
        
        .table-card { background: white; 
            padding: 24px; 
            border-radius: 8px; 
            box-shadow: 0 1px 4px rgba(0,0,0,0.1); 
        }
        
        table { width: 100%; 
            border-collapse: collapse; 
            font-size: 14px; 
        }
        
        th { background: #edf2f7; 
            text-align: left; 
            padding: 10px 12px; 
            color: #555; 
        }
        
        td { padding: 10px 12px; 
            border-bottom: 1px solid #eee; 
        }

        td:last-child { white-space: nowrap; } // fix actions buttons from getting out of place

        input.error, textarea.error { border-color: #e53e3e; }
        .error-msg { color: #e53e3e; 
            font-size: 13px; 
            margin-top: 4px; 
        }
    
        .alert-success { background: #c6f6d5; 
            color: #276749; 
            padding: 12px 16px; 
            border-radius: 4px; 
            margin-bottom: 20px; 
        }

        /* Status badges */
        .badge { padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .badge-pending  { background: #fefcbf; color: #744210; }
        .badge-approved { background: #c6f6d5; color: #22543d; }
        .badge-rejected { background: #fed7d7; color: #742a2a; }

        /* Action buttons */
        .btn-approve { background: #38a169; 
            color: white; 
            border: none; 
            padding: 6px 14px; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 13px; 
        }

        .btn-approve:hover { background: #2f855a; }

        .btn-reject  { background: #e53e3e; 
            color: white; 
            border: none; 
            padding: 6px 14px; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 13px; 
            margin-left: 6px; 
        }

        .btn-reject:hover  { background: #c53030; }
        
    </style>
</head>
<body>

    <h1>Leave Request System</h1>
    
    <div class ="form-card">
        <h2>Submit a Leave Request</h2>
   
        <!-- Sucess message -->
        @if (session('success'))
            <div class="alert-success"> {{ session('success') }} </div>
        @endif
        
        <form action = "{{ route('leave_requests.store') }}" method="POST">
            @csrf
            <!-- Form fields go here -->
            
            <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="{{ $errors->has('name') ? 'error' : '' }}">
                    @error('name')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
            </div>

            <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                        class="{{ $errors->has('start_date') ? 'error' : '' }}">
                    @error('start_date')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                        class="{{ $errors->has('end_date') ? 'error' : '' }}">
                @error('end_date')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" rows="3"
                            class="{{ $errors->has('reason') ? 'error' : '' }}">{{ old('reason') }}</textarea>
                @error('reason')
                        <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Submit Request</button>

        </form>

    </div>

    <div class="table-card">
        <h2>All Leave Requests</h2>
        @if($requests->isEmpty())
            <p style="color:#888;">No leave requests yet.</p>
        @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $req)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $req->name }}</td>
                    <td>{{ $req->start_date }}</td>
                    <td>{{ $req->end_date }}</td>
                    <td>{{ $req->reason }}</td>
                    <td>
                        <span class="badge badge-{{ strtolower($req->status) }}">
                            {{ $req->status }}
                        </span>
                    </td>
                    <td>
                        @if($req->status === 'Pending')
                        <form action="{{ route('leave_requests.update', $req->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="Approved">
                            <button type="submit" class="btn-approve">Approve</button>
                        </form>
                        <form action="{{ route('leave_requests.update', $req->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="Rejected">
                            <button type="submit" class="btn-reject">Reject</button>
                        </form>
                        @else
                            <span style="color:#aaa; font-size:13px;">No action</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

</body>
</html>