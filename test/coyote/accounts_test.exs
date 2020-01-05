defmodule Coyote.AccountsTest do
  use Coyote.DataCase

  alias Coyote.Accounts

  describe "users" do
    alias Coyote.Accounts.User

    @valid_attrs %{
      email: "email-0@example.com",
      password: "test1234",
      password_confirmation: "test1234",
      receives_email: true,
      first_name: "Test",
      last_name: "User",
      address: "123 Test Ln., New York, NY 12345",
      phone: "555-555-1234",
      grad_year: 2000,
      roll_number: 100,
      employer: "Acme, Inc.",
      latitude: 40.6976637,
      longitude: -74.1197638,
      lifetime_member: false
    }

    @update_attrs %{}

    @invalid_attrs %{
      email: "not-and-email",
      password: "passwd",
      password_confirmation: "false"
    }

    def user_fixture(attrs \\ %{}) do
      {:ok, user} =
        attrs
        |> Enum.into(@valid_attrs)
        |> Accounts.create_user()

      user
    end

    test "list_users/0 returns all users" do
      user = user_fixture()

      assert Accounts.list_users(%{page: 1}) == %{
               users: [user],
               page_size: 25,
               page_number: 1,
               total_entries: 1,
               total_pages: 1
             }
    end

    test "get_user!/1 returns the user with given id" do
      user = user_fixture()
      assert Accounts.get_user!(user.id) == user
    end

    test "create_user/1 with valid data creates a user" do
      assert {:ok, %User{} = user} = Accounts.create_user(@valid_attrs)
    end

    test "create_user/1 with invalid data returns error changeset" do
      assert {:error, %Ecto.Changeset{}} = Accounts.create_user(@invalid_attrs)
    end

    test "update_user/2 with valid data updates the user" do
      user = user_fixture()
      assert {:ok, %User{} = user} = Accounts.update_user(user, @update_attrs)
    end

    test "update_user/2 with invalid data returns error changeset" do
      user = user_fixture()
      assert {:error, %Ecto.Changeset{}} = Accounts.update_user(user, @invalid_attrs)
      assert user == Accounts.get_user!(user.id)
    end

    test "delete_user/1 deletes the user" do
      user = user_fixture()
      assert {:ok, %User{}} = Accounts.delete_user(user)
      assert_raise Ecto.NoResultsError, fn -> Accounts.get_user!(user.id) end
    end

    test "change_user/1 returns a user changeset" do
      user = user_fixture()
      assert %Ecto.Changeset{} = Accounts.change_user(user)
    end
  end
end
