defmodule Coyote.PaymentsTest do
  use Coyote.DataCase

  alias Coyote.Payments

  describe "payments" do
    alias Coyote.Payments.Stripe

    @valid_attrs %{subject: "some subject"}
    @update_attrs %{subject: "some updated subject"}
    @invalid_attrs %{subject: nil}
  end
end
