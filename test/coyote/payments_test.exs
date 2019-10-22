defmodule Coyote.PaymentsTest do
  use Coyote.DataCase

  alias Coyote.Payments

  describe "payments" do
    alias Coyote.Payments.Stripe

    @valid_attrs %{subject: "some subject"}
    @update_attrs %{subject: "some updated subject"}
    @invalid_attrs %{subject: nil}

    def stripe_fixture(attrs \\ %{}) do
      {:ok, stripe} =
        attrs
        |> Enum.into(@valid_attrs)
        |> Payments.create_stripe()

      stripe
    end

    test "list_payments/0 returns all payments" do
      stripe = stripe_fixture()
      assert Payments.list_payments() == [stripe]
    end

    test "get_stripe!/1 returns the stripe with given id" do
      stripe = stripe_fixture()
      assert Payments.get_stripe!(stripe.id) == stripe
    end

    test "create_stripe/1 with valid data creates a stripe" do
      assert {:ok, %Stripe{} = stripe} = Payments.create_stripe(@valid_attrs)
      assert stripe.subject == "some subject"
    end

    test "create_stripe/1 with invalid data returns error changeset" do
      assert {:error, %Ecto.Changeset{}} = Payments.create_stripe(@invalid_attrs)
    end

    test "update_stripe/2 with valid data updates the stripe" do
      stripe = stripe_fixture()
      assert {:ok, %Stripe{} = stripe} = Payments.update_stripe(stripe, @update_attrs)
      assert stripe.subject == "some updated subject"
    end

    test "update_stripe/2 with invalid data returns error changeset" do
      stripe = stripe_fixture()
      assert {:error, %Ecto.Changeset{}} = Payments.update_stripe(stripe, @invalid_attrs)
      assert stripe == Payments.get_stripe!(stripe.id)
    end

    test "delete_stripe/1 deletes the stripe" do
      stripe = stripe_fixture()
      assert {:ok, %Stripe{}} = Payments.delete_stripe(stripe)
      assert_raise Ecto.NoResultsError, fn -> Payments.get_stripe!(stripe.id) end
    end

    test "change_stripe/1 returns a stripe changeset" do
      stripe = stripe_fixture()
      assert %Ecto.Changeset{} = Payments.change_stripe(stripe)
    end
  end
end
