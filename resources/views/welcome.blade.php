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

    <div class ="table-card">
        <h2>All leave Requests</h2>>
        <p>Table of all leave requests</p>
    </div>

</body>
</html>