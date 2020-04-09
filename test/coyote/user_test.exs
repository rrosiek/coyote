defmodule Coyote.UserTest do
  use Coyote.DataCase
  import ValidField

  describe "changesets" do
    alias Coyote.Accounts.User

    test ".create - Validations" do
      with_changeset(%User{}, fn model, params -> User.create(model, params) end)
      |> assert_field(:email, ["something@else.com"], ["", nil, "test-else.com"])
      |> assert_field(:password, ["password123!"], [nil, "", "sml"])
      |> assert_field(:receives_email, [true, false], [nil, 1, "true"])

      # :password_confirmation,
      # :last_name,
      # :first_name,
      # :address,
      # :phone,
      # :grad_year,
      # :roll_number,
      # :employer,
      # :latitude,
      # :longitude,
      # :lifetime_member,
      # :deceased
    end

    test ".update - Validations" do
      with_changeset(%User{}, fn model, params -> User.update(model, params) end)
      |> assert_field(:email, ["something@else.com"], ["test-else.com"])
      |> assert_field(:password, ["password123!"], ["sml"])

      # :password_confirmation,
      # :receives_email,
      # :last_name,
      # :first_name,
      # :address,
      # :phone,
      # :grad_year,
      # :roll_number,
      # :employer,
      # :latitude,
      # :longitude,
      # :lifetime_member,
      # :deceased
    end
  end
end
