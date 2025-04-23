<div class="form-group">
    <label for="vehicle_id">Kendaraan</label>
    <select name="vehicle_id" id="vehicle_id" class="form-control" required>
        @foreach($vehicles as $vehicle)
            <option value="{{ $vehicle->id }}" @selected(old('vehicle_id', $booking->vehicle_id ?? '') == $vehicle->id)>
                {{ $vehicle->name }} ({{ $vehicle->type }})
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="driver_id">Supir</label>
    <select name="driver_id" id="driver_id" class="form-control" required>
        @foreach($drivers as $driver)
            <option value="{{ $driver->id }}" @selected(old('driver_id', $booking->driver_id ?? '') == $driver->id)>
                {{ $driver->name }} - {{ $driver->phone }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="booking_date">Tanggal Pemesanan</label>
    <input type="date" name="booking_date" class="form-control" value="{{ old('booking_date', $booking->booking_date ?? date('Y-m-d')) }}" required>
</div>

<div class="form-group">
    <label for="start_date">Tanggal Mulai</label>
    <input type="datetime-local" name="start_date" class="form-control" value="{{ old('start_date', $booking->start_date ?? '') }}" required>
</div>

<div class="form-group">
    <label for="end_date">Tanggal Selesai</label>
    <input type="datetime-local" name="end_date" class="form-control" value="{{ old('end_date', $booking->end_date ?? '') }}" required>
</div>

<div class="form-group">
    <label for="approver_1_id">Approver Level 1</label>
    <select name="approver_1_id" class="form-control" required>
        @foreach($approvers1 as $approver)
            <option value="{{ $approver->id }}">{{ $approver->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="approver_2_id">Approver Level 2</label>
    <select name="approver_2_id" class="form-control" required>
        @foreach($approvers2 as $approver)
            <option value="{{ $approver->id }}">{{ $approver->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="notes">Catatan</label>
    <textarea name="notes" class="form-control">{{ old('notes', $booking->notes ?? '') }}</textarea>
</div>
