<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Tracker</title>
    <style>
        /* Container for the progress tracker */
        * {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 50px;
            position: relative;
        }

        .step::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 9.5px;
            height: calc(100% + 30px);
            border-left: 2px dashed #ddd; 
            z-index: 1;
        }
        .step:last-child::before {
            border-left: none;
            height: 0;
        }
        .step .circle {
            position: relative;
            z-index: 2;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
            font-weight: bold;
        }

        .step.completed .circle {
            background-color: #4CAF50;
        }

        .step.completed .status {
            color: #4CAF50;
        }

        .step.review .circle {
            background-color: #4CAF50;
        }

        .step.review .status {
            color: orange;
        }

        .step.incomplete .circle {
            background-color: #ccc;
        }

        .step.incomplete .title, .step.incomplete .status, .step.incomplete .description {
            color: #ccc;
        }

        .content {
            padding-left: 15px;
        }

        .title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .description {
            color: #666;
            font-size: 14px;
        }

        .status {
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="step completed">
    <div class="circle">✓</div>
    <div class="content">
        <div class="title">The registration has been generated successfully!</div>
        <div class="description">You can download a copy from the email we have sent. Keep it safe!</div>
        <div class="status">Completed</div>
    </div>
</div>

<div class="step review">
    <div class="circle">✓</div>
    <div class="content">
        <div class="title">Document approval</div>
        <div class="description">You have uploaded everything we need.</div>
        <div class="status">Under Review</div>
    </div>
</div>

<div class="step incomplete">
    <div class="circle"></div>
    <div class="content">
        <div class="title">Add your stall</div>
        <div class="description">Send invitation link to your stall owners and manage their rental.</div>
    </div>
</div>

<div class="step incomplete">
    <div class="circle"></div>
    <div class="content">
        <div class="title">Activate centralized cash payment</div>
        <div class="description">You can activate or not this feature.</div>
    </div>
</div>

</body>
</html>
