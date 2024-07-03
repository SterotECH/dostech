<!-- resources/views/pdf/students.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body {
            padding: 2rem; /* px-2 py-8 */
            margin: auto; /* mx-auto */
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem; /* mb-8 */
        }

        .text-lg {
            font-size: 1.125rem; /* text-lg */
            font-weight: 600; /* font-semibold */
            color: #374151; /* text-gray-700 */
        }

        .text-gray-700 {
            color: #4b5563; /* text-gray-700 */
        }

        .text-xl {
            font-size: 1rem; /* text-xl */
            font-weight: 700; /* font-bold */
            text-transform: uppercase; /* uppercase */
            margin-bottom: 0.5rem; /* mb-2 */
        }

        .text-sm {
            font-size: 0.875rem; /* text-sm */
            color: #6b7280; /* text-gray-700 */
        }

        table {
            width: 100%; /* w-full */
            margin-bottom: 2rem; /* mb-8 */
            border-collapse: collapse;
        }

        th {
            padding: 0.5rem 1rem; /* py-2 */
            font-weight: 700; /* font-bold */
            text-transform: uppercase; /* uppercase */
            text-align: left;
            border-bottom: 2px solid #e5e7eb; /* border-b-2 */
            color: #374151; /* text-gray-700 */
        }

        td {
            padding: 1rem; /* py-4 */
            border-bottom: 1px solid #e5e7eb; /* border-b */
            color: #4b5563; /* text-gray-700 */
        }
    </style>
</head>
<body>
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center">
            <div class="text-lg font-semibold text-gray-700">St Dominic Senior High Technical</div>
        </div>
        <div class="text-gray-700">
            <div class="mb-2 text-xl font-bold uppercase">Student List</div>
            <div class="text-sm">Date: {{ now()->format('m/d/Y') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>House</th>
                <th>Department</th>
                <th>Dues Owed</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->house->name }}</td>
                    <td>{{ $student->department->name }}</td>
                    <td>{{ $student->dues_owed }}</td>
                    <td>{{ $student->classes->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
