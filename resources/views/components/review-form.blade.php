{{-- <fieldset> --}}
    <h2>Add a Review</h2>
    <div class="mt-row">
        <label>Rating</label>
        <ul class="mt-star">
            <div class="rate">
                <input type="radio" id="star5" class="rate"
                    name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" class="rate"
                    name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" class="rate"
                    name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" class="rate"
                    name="rate" value="2">
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" class="rate"
                    name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
            </div>
        </ul>

    </div>
    <div class="mt-row">
        <label>Review</label>
        <textarea class="form-control" name="feedback"></textarea>
    </div>
    <div style="margin-left: 80px;margin-bottom:20px;color:red"
        id="review-error"></div>
{{-- </fieldset> --}}